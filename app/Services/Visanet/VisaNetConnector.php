<?php


namespace App\Services\Visanet;

use crocodicstudio\crudbooster\helpers\CRUDBooster;

class VisaNetConnector {

	private $merchantId;
	private $user;
	private $password;

	/**
	 * VisaNetConnector constructor.
	 *
	 */
	public function __construct() {
		$this->merchantId = CRUDBooster::getSetting('merchant_id');
		$this->user       = CRUDBooster::getSetting('user');
		$this->password   = CRUDBooster::getSetting('password');
	}

	private function getTokenSecurity(){
		$url = CRUDBooster::getSetting('api_security_url');
		$headers = [
		'Authorization' => 'Basic'
		];
		$response = ClientHttp::makeGet($url)
	}

}