<?php

use Illuminate\Database\Seeder;

class CmsPrivilegesRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_privileges_roles')->delete();
        
        \DB::table('cms_privileges_roles')->insert(array (
            0 => 
            array (
                'id' => 42,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 1,
                'id_cms_moduls' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 49,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 1,
                'id_cms_moduls' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 61,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 62,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 63,
                'is_visible' => 1,
                'is_create' => 0,
                'is_read' => 1,
                'is_edit' => 0,
                'is_delete' => 0,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 64,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 13,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 65,
                'is_visible' => 1,
                'is_create' => 0,
                'is_read' => 1,
                'is_edit' => 0,
                'is_delete' => 0,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 66,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 16,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 67,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 0,
                'id_cms_privileges' => 3,
                'id_cms_moduls' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 68,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 20,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 69,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 21,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 70,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 18,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 71,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 19,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 72,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 12,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 73,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 14,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 74,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 15,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 75,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 23,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 76,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 16,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 77,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 24,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 78,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 79,
                'is_visible' => 1,
                'is_create' => 1,
                'is_read' => 1,
                'is_edit' => 1,
                'is_delete' => 1,
                'id_cms_privileges' => 2,
                'id_cms_moduls' => 17,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}