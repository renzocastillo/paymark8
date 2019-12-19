<?php

use Illuminate\Database\Seeder;

class CmsSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings=array(
        array( 'id'=>'28', 'name'=>'correo_consultas', 'content'=>NULL, 'content_input_type'=>'email', 'dataenum'=>NULL, 'helper'=>'El correo al cual quieres que lleguen las consultas de Paymark8', 'created_at'=>'2019-12-16 15:36:50', 'updated_at'=>NULL, 'group_setting'=>'Oficina', 'label'=>'Correo para Recepción de Consultas')
        );
        DB::table('cms_settings')->insert($settings);
    }
}
