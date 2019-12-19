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
    }
}
