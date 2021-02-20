<?php


namespace App\Services\Visanet;

use Carbon\Carbon;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VisaNetConnector
{

    private static $USER_UUID_SEED = '4DFS6SDF4';
    private static $CHANNEL = 'web';


    private $merchantId;
    private $user;
    private $password;
  
    /**
     * VisaNetConnector constructor.
     *
     */
    public function __construct()
    {
        $this->merchantId = CRUDBooster::getSetting('merchant_id');
        $this->user = CRUDBooster::getSetting('user');
        $this->password = CRUDBooster::getSetting('password');
    }

    public function getSession($clientIp, $userId,$item)
    {
        $lastPurchase = $this->getLastPurchaseByUserId($userId);
        $url = CRUDBooster::getSetting('api_url') . $this->merchantId;
        $token = $this->getTokenSecurity();
        $number = rand(0, 1000000000);
        $headers = [
            'Authorization' => $token
        ];
        $body = [
            'amount' => number_format($item['amount'], 2, '.', ''),
            'antifraud' => [
                'clientIp' => $clientIp,
                'merchantDefineData' => [
                    'MDD{Nºx}' => $number,
                    'MDD{Nºx+1}' => $number + 1,
                    'MDD{Nºx+2}' => $number + 2
                ]
            ],
            'dataMap' => [
                'userToken' => md5(VisaNetConnector::$USER_UUID_SEED . $userId)
            ],
            'channel' => VisaNetConnector::$CHANNEL,
            'recurrenceMaxAmount' => number_format($item['amount'], 2, '.', '')
        ];
        $response = json_decode(ClientHttp::makePost($url, $headers, $body));
        if ($lastPurchase != null) {
            $id = $lastPurchase['purchase_id'];
        } else {
            $id = DB::table('purchases')->insertGetId(
            [
                'user_id' => $userId,
                'amount' => $item['amount'],
                'item_id' => $item['id'],
                'item_type' => $item['type'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
            );
        }
       
        $invoice = intval(CRUDBooster::getSetting('invoice')) + $id;
        if($item['type']=="1"){
            $item['details']=
            [
                'startDate' => Carbon::now()->toDateString(),
                'endDate' => Carbon::now()->addYear(1)->toDateString(),
            ];
        }

        return [
            'session' => $response->sessionKey,
            'channel' => VisaNetConnector::$CHANNEL,
            'merchant_id' => $this->merchantId,
            'amount' => number_format($item['amount'], 2, '.', ''),
            'trx_id' => $invoice,
            'script_url' => CRUDBooster::getSetting('script_url'),
            'logo' => asset(CRUDBooster::getSetting('logo_checkout')),
            'user' => md5(VisaNetConnector::$USER_UUID_SEED . $userId),
            'item'=> $item,
            'url_timeout' => url('/visanet/timeout')
        ];
    }

    public function getLastPurchaseByUserId($userId)
    {
        $purchase = DB::table('purchases')->where('user_id', $userId)
            ->where('status', 'pending')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->first();
        if ($purchase != null) {
            return [
                'channel' => VisaNetConnector::$CHANNEL,
                'merchant_id' => $this->merchantId,
                'amount' => number_format($purchase->amount, 2, '.', ''),
                'purchase_id' => $purchase->id,
            ];
        }

        return null;
    }

    private function getTokenSecurity()
    {

        $url = CRUDBooster::getSetting('api_security_url');
        $string = $this->user . ":" . $this->password;
        $bytes = array();
        for ($i = 0; $i < strlen($string); $i++) {
            $bytes[] = ord($string[$i]);
        }
        $headers = [
            'Authorization' => 'Basic ' . base64_encode($string)
        ];
        $response = ClientHttp::makeGet($url, $headers);
        $token = $response->getContents();

        return $token;
    }

    public function authorize($channel, $amount, $purchaseId, $tokenId)
    {
        
        try {
            $token = $this->getTokenSecurity();
            $url = CRUDBooster::getSetting('api_authorization_url') . $this->merchantId;
            $invoice = intval(CRUDBooster::getSetting('invoice')) + $purchaseId;
            $headers = [
                'Authorization' => $token
            ];
            $body = [
                'captureType' => 'manual',
                'channel' => $channel,
                'countable' => true,
                'order' => [
                    'amount' => $amount,
                    'currency' => CRUDBooster::getSetting('currency_visanet'),
                    'purchaseNumber' => $invoice,
                    'tokenId' => $tokenId
                    
                ]

            ];
            $response = json_decode(ClientHttp::makePost($url, $headers, $body));
            Log::info('Success Authorization', ['data' => $response]);
            $status = 'failed';
            if (intval($response->dataMap->ECI) == 5 || intval($response->dataMap->ECI) == 6 || intval($response->dataMap->ECI) == 7) {
                $status = 'accepted';
            }
            DB::table('purchases')
                ->where('id', $purchaseId)
                ->update([
                    'eci_code' => $response->dataMap->ECI,
                    'eci_description' => $response->dataMap->ECI_DESCRIPTION,
                    'transaction_id' => $response->dataMap->TRANSACTION_ID,
                    'transaction_date' => Carbon::createFromTimestamp($response->header->ecoreTransactionDate / 1000),
                    'transaction_amount' => $response->order->amount,
                    'transaction_currency' => $response->order->currency,
                    'signature' => $response->dataMap->SIGNATURE,
                    'status' => $status,
                    'transaction_invoice' => $response->order->purchaseNumber,
                    'card' => $response->dataMap->CARD,
                    'action_description' => $response->dataMap->ACTION_DESCRIPTION,
                ]);

        } catch (ClientException $exception) {
            if ($exception->hasResponse()) {
                $body = json_decode($exception->getResponse()->getBody());
                Log::info('Failed Authorization', ['data' => $body]);
                $status = 'failed';
                if ($body->data->ECI == 116) {
                    $status = 'insufficient_balance';
                }
                DB::table('purchases')
                    ->where('id', $purchaseId)
                    ->update([
                        'eci_code' => $body->data->ECI,
                        'eci_description' => $body->data->ECI_DESCRIPTION ? $body->data->ECI_DESCRIPTION : $body->data->ACTION_DESCRIPTION,
                        'transaction_id' => $body->data->TRANSACTION_ID,
                        'signature' => $body->data->SIGNATURE,
                        'status' => $status,
                        'transaction_date' => Carbon::createFromTimestamp($body->header->ecoreTransactionDate / 1000),
                        'transaction_invoice' => $invoice,
                        'card' => $body->data->CARD,
                        'action_description' => $body->data->ACTION_DESCRIPTION,
                    ]);
            }
        } catch (\Exception $exception) {
            Log::error('Error in authorization', ['data' => $exception]);
            DB::table('purchases')
                ->where('id', $purchaseId)
                ->update([
                    'status' => 'faileddd',
                    'action_description'=>$exception,
                ]);
        }

        $result = DB::table('purchases')->where('purchases.id', $purchaseId)
        ->join('cms_users', 'cms_users.id', '=', 'purchases.user_id')
        ->select('purchases.*', 'cms_users.name')
        ->get()
        ->first();
        
        return $result;
    }
}
