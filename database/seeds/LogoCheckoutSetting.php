<?php

use Illuminate\Database\Seeder;

class LogoCheckoutSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table( 'cms_settings' )->insert( [
			[
				'name'               => 'logo_checkout',
				'content_input_type' => 'upload_image',
				'created_at'         => \Carbon\Carbon::now(),
				'updated_at'         => NULL,
				'group_setting'      => 'visanet',
				'label'              => 'Logo que se usará en popup de procesar el pago',
			]
		] );
    }
}
