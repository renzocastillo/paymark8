<?php


namespace App\Services\Visanet;


use GuzzleHttp\Client;

class ClientHttp {


	public static function makeGet( $url, $headers = array(), $params = array() ) {
		$client = new Client();
		$res    = $client->request( 'GET', $url, [
			'headers' => $headers
		] );
		if ( $res->getStatusCode() == 200 || $res->getStatusCode() == 201 ) {
			return $res->getBody();
		} else {
			throw new \Exception( $res->getBody(), $res->getStatusCode() );
		}
	}

	public static function makePost( $url, $headers = array(), $body = array() ) {
		$client = new Client();
		$res    = $client->request( 'POST', $url, [
			'headers' => $headers,
			'json'    => $body
		] );
		if ( $res->getStatusCode() == 200 || $res->getStatusCode() == 201) {
			return $res->getBody();
		}
		else {
			throw new \Exception( $res->getBody(), $res->getStatusCode() );
		}
	}
}