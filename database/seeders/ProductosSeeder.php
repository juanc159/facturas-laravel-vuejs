<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productos = ['Tarjeta grafica ','Placas','Computador','Mouse','Teclado','Telefono','Chip','Circuito','Pantalla Led','Microfono'];
        for ($i=0; $i < 10; $i++) { 
            $producto = new Producto();
            $producto->nombreProducto =  $productos[$i];
            $producto->valorUnitario  =  random_int(10,100);
            $producto->save() ;
        }
    }
}
