<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emisor;

class EmisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $emisor = new Emisor;
        $emisor->nombreEmisor =  'Electronica J J E U';
        $emisor->nitEmisor  =  'Instalaciones electricas';
        $emisor->save() ;
    }
}
