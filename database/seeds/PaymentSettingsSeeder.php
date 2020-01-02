<?php

use Illuminate\Database\Seeder;

class PaymentSettingsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		\DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'annual_membership_amount',
				'content_input_type' => 'number',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'afiliacion',
				'label'              => 'Precio Anual de Afiliacion',
			],
			[
				'name'               => 'monthly_membership_amount',
				'content_input_type' => 'number',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => \Carbon\Carbon::now(),
				'group_setting'      => 'afiliacion',
				'label'              => 'Precio Mensual de Afiliacion',
			]
		] );

		$id = \DB::table( 'cms_menus' )->insertGetId(
			[
				'name'              => 'Afiliaciones',
				'type'              => 'URL',
				'path'              => 'configuraciones?group=afiliacion',
				'color'             => 'normal',
				'icon'              => 'fa fa-usd',
				'parent_id'         => 4,
				'is_active'         => 1,
				'is_dashboard'      => 0,
				'id_cms_privileges' => 1,
				'sorting'           => 7,
				'created_at'        => \Carbon\Carbon::now(),
				'updated_at'        => \Carbon\Carbon::now(),
			]
		);
		\DB::table( 'cms_menus_privileges' )->insert(
			array(
				'id_cms_menus'      => $id,
				'id_cms_privileges' => 2,
			) );
	}
}
