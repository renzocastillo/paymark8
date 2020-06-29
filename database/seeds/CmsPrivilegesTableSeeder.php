<?php

use Illuminate\Database\Seeder;

class CmsPrivilegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_privileges')->delete();
        
        \DB::table('cms_privileges')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Super Administrator',
                'is_superadmin' => 1,
                'theme_color' => 'custom-skin',
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Administrador',
                'is_superadmin' => 0,
                'theme_color' => 'custom-skin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Usuario',
                'is_superadmin' => 0,
                'theme_color' => 'custom-skin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}