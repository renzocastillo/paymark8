<?php

use Illuminate\Database\Seeder;

class CmsMenusPrivilegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_menus_privileges')->delete();
        
        \DB::table('cms_menus_privileges')->insert(array (
            0 => 
            array (
                'id' => 5,
                'id_cms_menus' => 1,
                'id_cms_privileges' => 2,
            ),
            1 => 
            array (
                'id' => 10,
                'id_cms_menus' => 3,
                'id_cms_privileges' => 2,
            ),
            2 => 
            array (
                'id' => 13,
                'id_cms_menus' => 2,
                'id_cms_privileges' => 2,
            ),
            3 => 
            array (
                'id' => 17,
                'id_cms_menus' => 5,
                'id_cms_privileges' => 2,
            ),
            4 => 
            array (
                'id' => 25,
                'id_cms_menus' => 6,
                'id_cms_privileges' => 2,
            ),
            5 => 
            array (
                'id' => 26,
                'id_cms_menus' => 7,
                'id_cms_privileges' => 2,
            ),
            6 => 
            array (
                'id' => 27,
                'id_cms_menus' => 8,
                'id_cms_privileges' => 2,
            ),
            7 => 
            array (
                'id' => 31,
                'id_cms_menus' => 9,
                'id_cms_privileges' => 2,
            ),
            8 => 
            array (
                'id' => 33,
                'id_cms_menus' => 11,
                'id_cms_privileges' => 2,
            ),
            9 => 
            array (
                'id' => 34,
                'id_cms_menus' => 4,
                'id_cms_privileges' => 2,
            ),
            10 => 
            array (
                'id' => 36,
                'id_cms_menus' => 12,
                'id_cms_privileges' => 3,
            ),
            11 => 
            array (
                'id' => 42,
                'id_cms_menus' => 13,
                'id_cms_privileges' => 3,
            ),
            12 => 
            array (
                'id' => 43,
                'id_cms_menus' => 14,
                'id_cms_privileges' => 3,
            ),
            13 => 
            array (
                'id' => 44,
                'id_cms_menus' => 16,
                'id_cms_privileges' => 3,
            ),
            14 => 
            array (
                'id' => 45,
                'id_cms_menus' => 15,
                'id_cms_privileges' => 3,
            ),
            15 => 
            array (
                'id' => 48,
                'id_cms_menus' => 10,
                'id_cms_privileges' => 2,
            ),
            16 => 
            array (
                'id' => 49,
                'id_cms_menus' => 10,
                'id_cms_privileges' => 3,
            ),
            17 => 
            array (
                'id' => 51,
                'id_cms_menus' => 17,
                'id_cms_privileges' => 3,
            ),
            18 => 
            array (
                'id' => 56,
                'id_cms_menus' => 18,
                'id_cms_privileges' => 2,
            ),
            19 => 
            array (
                'id' => 57,
                'id_cms_menus' => 18,
                'id_cms_privileges' => 3,
            ),
            20 => 
            array (
                'id' => 60,
                'id_cms_menus' => 20,
                'id_cms_privileges' => 2,
            ),
            21 => 
            array (
                'id' => 61,
                'id_cms_menus' => 19,
                'id_cms_privileges' => 2,
            ),
            22 => 
            array (
                'id' => 62,
                'id_cms_menus' => 19,
                'id_cms_privileges' => 3,
            ),
        ));
        
        
    }
}