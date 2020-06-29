<?php

use Illuminate\Database\Seeder;

class CmsEmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_email_templates')->delete();
        
        \DB::table('cms_email_templates')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Activación de Usuario Exitosa',
                'slug' => 'activacion_exitosa',
                'subject' => 'Activación de Cuenta Exitosa',
                'content' => '<p>[nombre], hemos recibido tu pago y ahora tu cuenta se encuentra <b>activada</b> para que puedas empezar a ganar! </p><p><br></p><p>Te brindamos tu link para compartir: <a href="[link]" target="_blank">[link]</a></p><p><br></p><p>Muchos éxitos en tu día,</p><p><br></p><p>Equipo Paymark8</p>',
                'description' => 'correo que llega cuando un usuario es activado',
                'from_name' => 'Paymark',
                'from_email' => 'server@paymark8.com',
                'cc_email' => NULL,
                'created_at' => '2019-09-02 10:50:45',
                'updated_at' => '2019-09-20 08:33:54',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Olvidé mi contraseña',
                'slug' => 'forgot_password_backend',
                'subject' => 'Recuperación de Contraseña',
                'content' => '<p>Hola,</p><p>Solicitaste una recuperación de contraseña, te brindamos tu nueva contraseña temporal :&nbsp;</p><p>[password]</p><p><br></p><p>Puedes cambiarla después entrado al menú perfil</p><p>--</p><p>Éxitos en tu día,</p><p>Equipo Paymark8</p>',
                'description' => '[password]',
                'from_name' => 'Paymark8',
                'from_email' => 'server@paymark8.com',
                'cc_email' => NULL,
                'created_at' => '2019-09-13 05:06:29',
                'updated_at' => '2019-09-20 10:33:09',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Consulta desde Plataforma',
                'slug' => 'consulta',
                'subject' => '[asunto]',
                'content' => '<p>[nombre] ha enviado el siguiente mensaje:</p><p>[mensaje]</p><p><br></p><p>Sus datos de contacto son:</p><p>Email: [email]</p><p>Whatsapp: [whatsapp]</p>',
                'description' => 'Consulta desde la plataforma',
                'from_name' => 'Paymark8',
                'from_email' => 'server@paymark8.com',
                'cc_email' => NULL,
                'created_at' => '2019-12-16 15:57:33',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}