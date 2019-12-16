<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use OpenGraph;

class ProductOPGService {

	private static $minutes = 7200;

	public static function getProductInformation( $url ) {
		if ( Cache::has( $url ) ) {
			return Cache::get( $url, [] );
		} else {
			$opg = OpenGraph::fetch( $url );
			Cache::put( $url, $opg, ProductOPGService::$minutes );

			return $opg;
		}
	}
}