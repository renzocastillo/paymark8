<?php


namespace App\Services\Visanet;

use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Support\Facades\Cache;

class VisaNetConnector
{

    private static $USER_UUID_SEED = '4DFS6SDF4';
    private static $CHANNEL = 'web';
    private static $CACHE_EXPIRATION = 1800;

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

    public function getSession($amount, $clientIp, $userId)
    {
        $url = CRUDBooster::getSetting('api_url') . $this->merchantId;
        $token = $this->getTokenSecurity();
        $number = rand(0, 1000000000);
        $headers = [
            'Authorization' => $token
        ];
        $body = [
            'amount' => number_format($amount, 2, '.', ''),
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
            'recurrenceMaxAmount' => number_format($amount, 2, '.', '')
        ];
        $response = json_decode(ClientHttp::makePost($url, $headers, $body));
        $trxId = $this->generateTransactionNumber($amount, $userId);
        Cache::put($trxId,
            [
                'session' => $response->sessionKey,
                'channel' => VisaNetConnector::$CHANNEL,
                'merchant_id' => $this->merchantId,
                'amount' => $amount,
                'trx_id' => $trxId
            ]
            , VisaNetConnector::$CACHE_EXPIRATION);
        return $trxId;
    }

    public function getTransactionData($trxId)
    {
        if (!Cache::has($trxId)) {
            throw new \Exception('Transaction data not found');
        }
        return Cache::get($trxId);
    }

    private function generateTransactionNumber($amount, $userId)
    {
        return md5(uniqid() . $amount . $userId);
    }


}