<?php


namespace App\Http\Controllers;


use App\Services\Visanet\VisaNetConnector;
use App\Http\Controllers\SubscriptionController;
use App\Models\CmsUser;
use App\Models\Course;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VisanetController extends Controller
{

    private $connector;
    private $subscription;

    /**
     * VisanetController constructor.
     *
     * @param $connector
     */
    public function __construct()
    {
        $this->connector = new VisaNetConnector();
        $this->subscription = new SubscriptionController();
    }


    public function getToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'userId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $this->connector->getSession($request->getClientIp(), $request->get('userId'),$request->get('item'))
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
        $item= $input['item'];
        $userId = CRUDBooster::myId();
        $data = $this->connector->getLastPurchaseByUserId($userId);
        $purchase = $this->connector->authorize($channel, $data['amount'], $data['purchase_id'], $token);
        if ($purchase->status == 'accepted') {
            if($item['type'] == 1){
                $this->subscription->activateUser($userId);
            }else{
                $course= Course::find($item['id']);
                $user  = CmsUser::find($userId);
                $course->cms_users()->attach($user);       
            }
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
