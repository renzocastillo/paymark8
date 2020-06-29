<?php

use Illuminate\Database\Seeder;

class CmsUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_users')->delete();
        
        \DB::table('cms_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Developers',
                'photo' => NULL,
                'email' => 'developers@ejemplo.com',
                'password' => '$2y$10$I/5zXm.LXX4cynus6a7up.QhYEntErfyxZf9HTa5pLpFCRlFeX6Qq',
                'id_cms_privileges' => 1,
                'created_at' => '2019-09-24 16:16:04',
                'updated_at' => NULL,
                'activated_at' => NULL,
                'status' => NULL,
                'cms_users_id' => NULL,
                'email_paypal' => NULL,
                'estado' => NULL,
                'vistas_actuales' => 0,
                'afiliaciones_actuales' => 0,
                'nietos_actuales' => 0,
                'whatsapp' => NULL,
                'slug' => NULL,
                'premium' => 0,
                'country_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Usuario',
                'photo' => NULL,
                'email' => 'usuario@ejemplo.com',
                'password' => '$2y$10$I/5zXm.LXX4cynus6a7up.QhYEntErfyxZf9HTa5pLpFCRlFeX6Qq',
                'id_cms_privileges' => 3,
                'created_at' => '2019-09-13 10:56:28',
                'updated_at' => '2019-12-15 14:46:04',
                'activated_at' => '2020-01-12 04:07:55',
                'status' => NULL,
                'cms_users_id' => NULL,
                'email_paypal' => NULL,
                'estado' => NULL,
                'vistas_actuales' => 0,
                'afiliaciones_actuales' => 0,
                'nietos_actuales' => 0,
                'whatsapp' => NULL,
                'slug' => 'usuario',
                'premium' => 0,
                'country_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Administrador',
                'photo' => NULL,
                'email' => 'admin@ejemplo.com',
                'password' => '$2y$10$wk42iiwL1o.NkFxkbLY/y.jkbBTbcTbvymEa3IwQSAlMQiM0ogqhi',
                'id_cms_privileges' => 2,
                'created_at' => '2019-09-24 16:16:04',
                'updated_at' => '2019-12-15 14:46:28',
                'activated_at' => NULL,
                'status' => NULL,
                'cms_users_id' => NULL,
                'email_paypal' => NULL,
                'estado' => NULL,
                'vistas_actuales' => 0,
                'afiliaciones_actuales' => 0,
                'nietos_actuales' => 0,
                'whatsapp' => NULL,
                'slug' => NULL,
                'premium' => 0,
                'country_id' => NULL,
            ),
        ));
        
        
    }
}