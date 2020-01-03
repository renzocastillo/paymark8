<?php


namespace App\Http\Controllers;


use App\Services\Visanet\VisaNetConnector;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisanetController extends Controller
{

    private $connector;

    /**
     * VisanetController constructor.
     * @param $connector
     */
    public function __construct()
    {
        $this->connector = new VisaNetConnector();
    }


    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'userId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $this->connector->getSession($request->get('amount'), $request->getClientIp(), $request->get('userId'))
        ]);
    }


    public function getIframeView($trxId)
    {
        $data = $this->connector->getTransactionData($trxId);
        return view('components.checkout')
            ->with('data', $data)
            ->with('script_url', CRUDBooster::getSetting('script_url'));
    }

}