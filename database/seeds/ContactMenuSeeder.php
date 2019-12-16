<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $id = DB::table( 'cms_menus' )->insertGetId(
		    [
			    'name'              => 'Contacto',
			    'type'              => 'URL',
			    'path'              => 'contact',
			    'color'             => null,
			    'icon'              => 'fa fa-message',
			    'parent_id'         => 0,
			    'is_active'         => 1,
			    'is_dashboard'      => 0,
			    'id_cms_privileges' => 1,
			    'sorting'           => 13,
		    ]
	    );

	    DB::table( 'cms_menus_privileges' )->insert(
		    [
			    'id_cms_menus' => $id,
			    'id_cms_privileges'    => 3
		    ]
	    );
    }
}
