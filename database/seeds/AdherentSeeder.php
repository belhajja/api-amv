<?php

use App\Adherent;
use Illuminate\Database\Seeder;

class AdherentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Adherent::class, 500)->create();
    }
}
