<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsMenusTableSeeder extends Seeder
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
			    'name'              => 'Tipos de Consultas',
			    'type'              => 'Module',
			    'path'              => 'tipos_de_consultas',
			    'color'             => 'normal',
			    'icon'              => 'fa fa-comments',
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
			    'id_cms_privileges'    => 2
		    ]
	    );
    }
}
