<?php


namespace App\Http\Controllers;


use App\Services\Visanet\VisaNetConnector;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VisanetController extends Controller
{

    private $connector;

    /**
     * VisanetController constructor.
     *
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


    public function timeout()
    {
        Session::put('timeout', true);
        return redirect('admin/resumen');

    }

    public function checkout(Request $request)
    {
        $input = $request->all();
        $token = $input['transactionToken'];
        $channel = $input['channel'];
        $userId = CRUDBooster::myId();
        $data = $this->connector->getLastPurchaseByUserId($userId);
        $purchase = $this->connector->authorize($channel, $data['amount'], $data['purchase_id'], $token);
        if ($purchase->status == 'accepted') {
            $this->connector->activateUser($userId);
        }
        Session::put('purchase', $purchase);
        return redirect('admin/resumen');

    }

    public function print($transactionId)
    {
        $transaction = DB::table('purchases')->where('purchases.id', $transactionId)
            ->join('cms_users', 'cms_users.id', '=', 'purchases.user_id')
            ->select('purchases.*', 'cms_users.name')
            ->get()
            ->first();

        if (empty($transactionId)) {
            return redirect('admin/resumen');
        }

        if (CRUDBooster::myId() != $transaction->user_id) {
            return redirect('admin/resumen');
        }

        return view('modules.print')
            ->with('logo', asset(CRUDBooster::getSetting('logo_checkout')))
            ->with('transaction', $transaction);

    }

}
