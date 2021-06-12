<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SocieteSeeder::class);
        $this->call(AdherentSeeder::class);
        $this->call(BeneficiaireSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(DossierSeeder::class);
        $this->call(DemandeSeeder::class);
        $this->call(TrackingDossierSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(DocumentSeeder::class);
    }
}
