<?php

use Illuminate\Database\Seeder;

class CmsModulsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_moduls')->delete();
        
        \DB::table('cms_moduls')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Notificaciones',
                'icon' => 'fa fa-cog',
                'path' => 'notifications',
                'table_name' => 'cms_notifications',
                'controller' => 'NotificationsController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Privilegios',
                'icon' => 'fa fa-cog',
                'path' => 'privileges',
                'table_name' => 'cms_privileges',
                'controller' => 'PrivilegesController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Privilegios & Roles',
                'icon' => 'fa fa-cog',
                'path' => 'privileges_roles',
                'table_name' => 'cms_privileges_roles',
                'controller' => 'PrivilegesRolesController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Usuarios',
                'icon' => 'fa fa-users',
                'path' => 'users',
                'table_name' => 'cms_users',
                'controller' => 'AdminCmsUsersController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Ajustes',
                'icon' => 'fa fa-cog',
                'path' => 'settings',
                'table_name' => 'cms_settings',
                'controller' => 'SettingsController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Generador de Módulos',
                'icon' => 'fa fa-database',
                'path' => 'module_generator',
                'table_name' => 'cms_moduls',
                'controller' => 'ModulsController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Gestión de Menús',
                'icon' => 'fa fa-bars',
                'path' => 'menu_management',
                'table_name' => 'cms_menus',
                'controller' => 'MenusController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Plantillas de Correo',
                'icon' => 'fa fa-envelope-o',
                'path' => 'email_templates',
                'table_name' => 'cms_email_templates',
                'controller' => 'EmailTemplatesController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Generador de Estadísticas',
                'icon' => 'fa fa-dashboard',
                'path' => 'statistic_builder',
                'table_name' => 'cms_statistics',
                'controller' => 'StatisticBuilderController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Generador de API',
                'icon' => 'fa fa-cloud-download',
                'path' => 'api_generator',
                'table_name' => '',
                'controller' => 'ApiCustomController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
            'name' => 'Log de Accesos (Usuarios)',
                'icon' => 'fa fa-flag-o',
                'path' => 'logs',
                'table_name' => 'cms_logs',
                'controller' => 'LogsController',
                'is_protected' => 1,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Ganancias',
                'icon' => 'fa fa-flag-o',
                'path' => 'ganancias',
                'table_name' => 'solicitudes_de_pago',
                'controller' => 'AdminGananciasController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Oficina',
                'icon' => 'fa fa-flag-o',
                'path' => 'oficina',
                'table_name' => 'cms_users',
                'controller' => 'AdminOficinaController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Tutoriales',
                'icon' => 'fa fa-flag-o',
                'path' => 'tutoriales',
                'table_name' => 'iframes',
                'controller' => 'AdminTutorialesController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 12:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Parametros',
                'icon' => 'fa fa-flag-o',
                'path' => 'parametros',
                'table_name' => 'parametros',
                'controller' => 'AdminParametrosController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Resumen',
                'icon' => 'fa fa-flag-o',
                'path' => 'resumen',
                'table_name' => 'cms_users',
                'controller' => 'AdminDashboardController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Videos',
                'icon' => 'fa fa-flag-o',
                'path' => 'videos',
                'table_name' => 'videos',
                'controller' => 'AdminVideosController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Contacto',
                'icon' => 'fa fa-flag-o',
                'path' => 'contacto',
                'table_name' => 'cms_settings',
                'controller' => 'AdminContactoController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Categorias de Curso',
                'icon' => 'fa fa-flag-o',
                'path' => 'categorias',
                'table_name' => 'course_categories',
                'controller' => 'AdminCourseCategoriesController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Anuncios',
                'icon' => 'fa fa-flag-o',
                'path' => 'anuncios',
                'table_name' => 'anuncios',
                'controller' => 'AdminAnunciosController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Configuraciones',
                'icon' => 'fa fa-flag-o',
                'path' => 'configuraciones',
                'table_name' => 'cms_settings',
                'controller' => 'AdminCmsSettingsController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-11 13:10:07',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Gestión de usuarios',
                'icon' => 'fa fa-users',
                'path' => 'users',
                'table_name' => 'cms_users',
                'controller' => 'AdminCmsUsersController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-09-13 05:06:29',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Cursos',
                'icon' => 'fa fa-flag-o',
                'path' => 'cursos',
                'table_name' => 'courses',
                'controller' => 'AdminCoursesController',
                'is_protected' => 0,
                'is_active' => 0,
                'created_at' => '2019-12-19 11:04:46',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Tipos de Consultas',
                'icon' => 'fa fa-comments',
                'path' => 'tipos_de_consultas',
                'table_name' => 'subjects',
                'controller' => 'AdminSubjectsController',
                'is_protected' => 0,
                'is_active' => 1,
                'created_at' => '2019-12-19 11:04:46',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}