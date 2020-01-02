<?php

use Illuminate\Database\Seeder;

class VisaNetSettingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'api_security_url',
				'content'            => 'https://apitestenv.vnforapps.com/api.security/v1/security',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Url Api seguridad',
			],
		] );
		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'api_url',
				'content'            => 'https://apitestenv.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Url Api',
			],
		] );
		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'script_url',
				'content'            => 'https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Url script url',
			],
		] );


		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'merchant_id',
				'content'            => '522591303',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Merchant Id',
			],
		] );

		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'user',
				'content'            => 'integraciones.visanet@necomplus.com',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Usuario',
			],
		] );

		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'password',
				'content'            => 'd5e7nk$M',
				'content_input_type' => 'text',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'visanet',
				'label'              => 'Contraseña',
			],
		] );
	}
}
