<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CountriesSeeder::class);
	    // $this->call(SubjectsMenuSeeder::class);
	    // $this->call(ProductAddTypeSeeder::class);
	    $this->call(ProductTypeSeeder::class);
        $this->call(CmsMenusTableSeeder::class);
        $this->call(CmsEmailTemplatesTableSeeder::class);
        $this->call(CmsMenusPrivilegesTableSeeder::class);
        $this->call(CmsPrivilegesRolesTableSeeder::class);
        $this->call(CmsModulsTableSeeder::class);
        $this->call(CmsSettingsTableSeeder::class);
    }
}
