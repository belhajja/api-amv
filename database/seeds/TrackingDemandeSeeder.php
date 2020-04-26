<?php

use App\TrackingDemande;
use Illuminate\Database\Seeder;

class TrackingDemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TrackingDemande::class, 10)->create();
    }
}
