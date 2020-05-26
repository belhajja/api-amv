<?php

use App\Beneficiaire;
use Illuminate\Database\Seeder;

class BeneficiaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Beneficiaire::class, 500)->create();
    }
}
