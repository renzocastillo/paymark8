<?php


namespace App\Services\Visanet;


use GuzzleHttp\Client;

class ClientHttp {


	public static function makeGet( $url, $headers = array(), $params = array() ) {
		$client = new Client();
		$res    = $client->request( 'GET', $url, [
			'headers' => $headers
		] );
		echo $res->getStatusCode();
	}
}