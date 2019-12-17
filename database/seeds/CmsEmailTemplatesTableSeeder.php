<?php

use Illuminate\Database\Seeder;

class CmsEmailTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $templates=array(
        array('id'=>'4', 'name'=>'Consulta desde Plataforma', 'slug'=>'consulta', 'subject'=>'[asunto]', 'content'=>'<p>[nombre] ha enviado el siguiente mensaje:</p><p>[mensaje]</p><p><br></p><p>Sus datos de contacto son:</p><p>Email: [email]</p><p>Whatsapp: [whatsapp]</p>','description'=>'Consulta desde la plataforma', 'from_name'=>'Paymark8', 'from_email'=>'server@paymark8.com', 'cc_email'=>NULL, 'created_at'=>'2019-12-16 15:57:33', 'updated_at'=>NULL)
       );
       DB::table('cms_email_templates')->insert($templates);

    }
}
