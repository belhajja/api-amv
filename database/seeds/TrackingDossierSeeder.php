<?php

use App\TrackingDossier;
use Illuminate\Database\Seeder;

class TrackingDossierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TrackingDossier::class, 500)->create();
    }
}
