<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleFactura', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDetalleFactura')->references('id')->on('facturas');
            $table->integer('idProducto');
            $table->integer('cantidadProducto');
            $table->float('valorUnitario');
            $table->float('valorTotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_factura');
    }
}
