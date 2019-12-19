<?php

use Illuminate\Database\Seeder;

class CmsSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_settings')->delete();
        
        \DB::table('cms_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'login_background_color',
            'content' => 'radial-gradient(circle,#4070fa, #000032);',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Input hexacode',
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Estilo de página de registro',
                'label' => 'Login Background Color',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'login_font_color',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Input hexacode',
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Estilo de página de registro',
                'label' => 'Login Font Color',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'login_background_image',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Estilo de página de registro',
                'label' => 'Login Background Image',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'email_sender',
                'content' => 'server@paymark8.com',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'Email Sender',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'smtp_driver',
                'content' => 'smtp',
                'content_input_type' => 'select',
                'dataenum' => 'smtp,mail,sendmail',
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'Mail Driver',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'smtp_host',
                'content' => 'smtp.zoho.com',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'SMTP Host',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'smtp_port',
                'content' => '465',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'default 25',
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'SMTP Port',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'smtp_username',
                'content' => 'server@paymark8.com',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'SMTP Username',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'smtp_password',
                'content' => 'Quaira2019@',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Correo',
                'label' => 'SMTP Password',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'appname',
                'content' => 'Paymark8',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Application Name',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'default_paper_size',
                'content' => 'Legal',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Paper size, ex : A4, Legal, etc',
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Default Paper Print Size',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'logo',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Logo',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'favicon',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Favicon',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'api_debug_mode',
                'content' => 'true',
                'content_input_type' => 'select',
                'dataenum' => 'true,false',
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'API Debug Mode',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'google_api_key',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Google API Key',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'google_fcm_key',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Google FCM Key',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'oficina_video_youtube',
                'content' => NUll,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Video de Youtube que ira en la oficina',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Oficina',
                'label' => 'Video en la Oficina',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'boton_paypal',
            'content' => NUll,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Obten el codigo del boton ingresando a la cuenta de tu comercio',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => '2019-12-18 19:38:11',
                'group_setting' => 'Ajustes de Aplicaciones',
                'label' => 'Boton para pago en línea',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'facebook',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'URL Facebook',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Sociales',
                'label' => 'Facebook',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'instagram',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'URL Instagram',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Sociales',
                'label' => 'Instagram',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'correo',
                'content' => 'soporte@paymark8.com',
                'content_input_type' => 'text',
                'dataenum' => NULL,
                'helper' => 'Correo',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Contacto',
                'label' => 'Correo',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'whatsapp',
                'content' => NULL,
                'content_input_type' => 'text',
                'dataenum' => NULL,
            'helper' => 'Número acompañado del cídigo del país (ej. +519988456)',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Contacto',
                'label' => 'Whatsapp',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'slider_1',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Sliders',
                'label' => 'Slider_1',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'slider_2',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Sliders',
                'label' => 'Slider 2',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'slider_3',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => NULL,
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Sliders',
                'label' => 'Slider 3',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'imagen_popup',
                'content' => NULL,
                'content_input_type' => 'upload_image',
                'dataenum' => NULL,
                'helper' => 'Es la imagen que carga al inicar la Página como popup',
                'created_at' => '2019-08-09 19:18:03',
                'updated_at' => NULL,
                'group_setting' => 'Landing',
                'label' => 'Imagen del Popup',
            ),
            26 => 
            array (
                'id' => 28,
                'name' => 'correo_consultas',
                'content' => NULL,
                'content_input_type' => 'email',
                'dataenum' => NULL,
                'helper' => 'El correo al cual quieres que lleguen las consultas de Paymark8',
                'created_at' => '2019-12-16 15:36:50',
                'updated_at' => NULL,
                'group_setting' => 'Oficina',
                'label' => 'Correo para Recepción de Consultas',
            ),
        ));
        
        
    }
}