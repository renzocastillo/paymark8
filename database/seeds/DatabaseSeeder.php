<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info('Sembrando nueva información en la BD...');
        Schema::disableForeignKeyConstraints();
        $this->call(CmsApicustomTableSeeder::class);
        $this->call(CmsApikeyTableSeeder::class);
        $this->call(CmsDashboardTableSeeder::class);
        $this->call(CmsEmailQueuesTableSeeder::class);
        $this->call(CmsEmailTemplatesTableSeeder::class);
        $this->call(CmsLogsTableSeeder::class);
        $this->call(CmsMenusTableSeeder::class);
        $this->call(CmsMenusPrivilegesTableSeeder::class);
        $this->call(CmsModulsTableSeeder::class);
        $this->call(CmsNotificationsTableSeeder::class);
        $this->call(CmsPrivilegesTableSeeder::class);
        $this->call(CmsPrivilegesRolesTableSeeder::class);
        $this->call(CmsSettingsTableSeeder::class);
        $this->call(CmsStatisticComponentsTableSeeder::class);
        $this->call(CmsStatisticsTableSeeder::class);
        $this->call(CmsUsersTableSeeder::class);
        $this->call(AnunciosTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(IframesTableSeeder::class);
        $this->call(ParametrosTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductTypesTableSeeder::class);
        $this->call(PurchasesTableSeeder::class);
        $this->call(ReproduccionesTableSeeder::class);
        $this->call(SolicitudesDePagoTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TiposDeIframeTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        Schema::enableForeignKeyConstraints();
        $this->command->info('Información sembrada con éxito !');
    }
}
