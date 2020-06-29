<?php

use Illuminate\Database\Seeder;

class CmsStatisticComponentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_statistic_components')->delete();
        
        \DB::table('cms_statistic_components')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_cms_statistics' => 1,
                'componentID' => '1e9ae1bef3b14c1d45352e05e69be0a2',
                'component_name' => 'chartline',
                'area_name' => 'area1',
                'sorting' => 0,
                'name' => NULL,
            'config' => '{"name":"Vistas Diarias del Mes","sql":"SELECT COUNT(id) as value, date(created_at) as label FROM paymark_sistema.reproducciones \\r\\n\\twhere cms_users_id=[admin_id]\\r\\n    and created_at >= date_sub(curdate(), INTERVAL 1 MONTH)\\r\\n    group by label ;","area_name":"Vistas","goals":null}',
                'created_at' => '2019-09-20 15:45:43',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}