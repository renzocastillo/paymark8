<?php


namespace App\Services\Visanet;

use Carbon\Carbon;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VisaNetConnector {

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
	public function __construct() {
		$this->merchantId = CRUDBooster::getSetting( 'merchant_id' );
		$this->user       = CRUDBooster::getSetting( 'user' );
		$this->password   = CRUDBooster::getSetting( 'password' );
	}

	private function getTokenSecurity() {

		$url    = CRUDBooster::getSetting( 'api_security_url' );
		$string = $this->user . ":" . $this->password;
		$bytes  = array();
		for ( $i = 0; $i < strlen( $string ); $i ++ ) {
			$bytes[] = ord( $string[ $i ] );
		}
		$headers  = [
			'Authorization' => 'Basic ' . base64_encode( $string )
		];
		$response = ClientHttp::makeGet( $url, $headers );
		$token    = $response->getContents();

		return $token;
	}

	public function getLastPurchaseByUserId( $userId ) {
		$purchase = DB::table( 'purchases' )->where( 'user_id', $userId )
		              ->where( 'status', 'pending' )
		              ->orderBy( 'created_at', 'DESC' )
		              ->get()
		              ->first();
		if ( $purchase != null ) {
			$invoice = intval( CRUDBooster::getSetting( 'invoice' ) ) + $purchase->id;

			return Cache::get( 'purchase_' . $invoice, null );
		}

		return null;
	}

	public function getSession( $amount, $clientIp, $userId ) {
		$url      = CRUDBooster::getSetting( 'api_url' ) . $this->merchantId;
		$token    = $this->getTokenSecurity();
		$number   = rand( 0, 1000000000 );
		$headers  = [
			'Authorization' => $token
		];
		$body     = [
			'amount'              => number_format( $amount, 2, '.', '' ),
			'antifraud'           => [
				'clientIp'           => $clientIp,
				'merchantDefineData' => [
					'MDD{Nºx}'   => $number,
					'MDD{Nºx+1}' => $number + 1,
					'MDD{Nºx+2}' => $number + 2
				]
			],
			'dataMap'             => [
				'userToken' => md5( VisaNetConnector::$USER_UUID_SEED . $userId )
			],
			'channel'             => VisaNetConnector::$CHANNEL,
			'recurrenceMaxAmount' => number_format( $amount, 2, '.', '' )
		];
		$response = json_decode( ClientHttp::makePost( $url, $headers, $body ) );

		$id      = DB::table( 'purchases' )->insertGetId(
			[
				'user_id'    => $userId,
				'amount'     => $amount,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]
		);
		$invoice = intval( CRUDBooster::getSetting( 'invoice' ) ) + $id;
		Cache::put( 'purchase_' . $invoice, [
			'channel'     => VisaNetConnector::$CHANNEL,
			'merchant_id' => $this->merchantId,
			'amount'      => number_format( $amount, 2, '.', '' ),
			'purchase_id' => $id,
		], VisaNetConnector::$CACHE_EXPIRATION );

		return [
			'session'     => $response->sessionKey,
			'channel'     => VisaNetConnector::$CHANNEL,
			'merchant_id' => $this->merchantId,
			'amount'      => number_format( $amount, 2, '.', '' ),
			'trx_id'      => $invoice,
			'script_url'  => CRUDBooster::getSetting( 'script_url' ),
			'logo'        => CRUDBooster::getSetting( 'logo' ),
			'user'        => md5( VisaNetConnector::$USER_UUID_SEED . $userId )
		];
	}

	public function authorize( $channel, $amount, $purchaseId, $tokenId ) {
		try {
			$token    = $this->getTokenSecurity();
			$url      = CRUDBooster::getSetting( 'api_authorization_url' ) . $this->merchantId;
			$invoice  = intval( CRUDBooster::getSetting( 'invoice' ) ) + $purchaseId;
			$headers  = [
				'Authorization' => $token
			];
			$body     = [
				'captureType' => 'manual',
				'channel'     => $channel,
				'countable'   => true,
				'order'       => [
					'amount'         => $amount,
					'currency'       => 'USD',
					'purchaseNumber' => $invoice,
					'tokenId'        => $tokenId
				]

			];
			$response = json_decode( ClientHttp::makePost( $url, $headers, $body ) );
			Log::info( 'Success Authorization', [ 'data' => $response ] );
			$status = 'failed';
			if ( intval( $response->dataMap->ECI ) == 5 || intval( $response->dataMap->ECI ) == 6 || intval( $response->dataMap->ECI ) == 7 ) {
				$status = 'accepted';
			}
			DB::table( 'purchases' )
			  ->where( 'id', $purchaseId )
			  ->update( [
				  'eci_code'        => $response->dataMap->ECI,
				  'eci_description' => $response->dataMap->ECI_DESCRIPTION,
				  'transaction_id'  => $response->dataMap->TRANSACTION_ID,
				  'signature'       => $response->dataMap->SIGNATURE,
				  'status'          => $status
			  ] );

		} catch ( ClientException $exception ) {
			if ( $exception->hasResponse() ) {
				$body = json_decode( $exception->getResponse()->getBody() );
				Log::info( 'Failed Authorization', [ 'data' => $body ] );
				$status = 'failed';
				if ( $body->data->ECI == 116 ) {
					$status = 'insufficient_balance';
				}
				DB::table( 'purchases' )
				  ->where( 'id', $purchaseId )
				  ->update( [
					  'eci_code'        => $body->data->ECI,
					  'eci_description' => $body->data->ECI_DESCRIPTION ? $body->data->ECI_DESCRIPTION : $body->data->ACTION_DESCRIPTION,
					  'transaction_id'  => $body->data->TRANSACTION_ID,
					  'signature'       => $body->data->SIGNATURE,
					  'status'          => $status
				  ] );
			}
		} catch ( \Exception $exception ) {
			Log::error( 'Error in authorization', [ 'data' => $exception ] );
			DB::table( 'purchases' )
			  ->where( 'id', $purchaseId )
			  ->update( [
				  'status' => 'failed'
			  ] );
		}

		return DB::table( 'purchases' )->where( 'id', $purchaseId )
		         ->get()
		         ->first();
	}

	public function activateUser( $userId ) {
		DB::table( 'cms_users' )
		  ->where( 'id', $userId )
		  ->update( [
			  'activated_at' => Carbon::now(),
			  'estado' => 1
		  ] );
		$user = DB::table( 'cms_users' )
		          ->where( 'id', $userId )
		          ->get()
		          ->first();
		$link = url( '/' . $user->slug );
		$data = [ 'nombre' => $user->name, 'link' => $link ];
		CRUDBooster::sendEmail( [ 'to' => $user->email, 'data' => $data, 'template' => 'activacion_exitosa' ] );
	}


}