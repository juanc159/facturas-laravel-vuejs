<?php

namespace Database\Seeders;

use App\Models\Comprador;
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
        // \App\Models\User::factory(10)->create(); 
        Comprador::factory()->count(10)->make();

        //$this->call(EmisorSeeder::class);
    }
}
