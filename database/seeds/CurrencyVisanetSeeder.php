<?php

use Illuminate\Database\Seeder;

class CurrencyVisanetSeeder extends Seeder
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
			    'name'               => 'currency_visanet',
			    'content'            => 'PEN',
			    'content_input_type' => 'text',
			    'created_at'         => \Carbon\Carbon::now(),
			    'updated_at'         => \Carbon\Carbon::now(),
			    'group_setting'      => 'visanet',
			    'label'              => 'Moneda de procesamiento',
		    ],
	    ] );
    }
}
