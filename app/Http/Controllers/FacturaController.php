<?php

namespace App\Http\Controllers;

use App\Models\Detallefactura;
use App\Models\Facturas;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            return Facturas::all();
        }else{
            return view('facturas.index');
        }
    }

    public function listarFacturas(){
        return Facturas::all();
    }

     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factura = new Facturas();
        $factura->fechaFactura = date('Y-m-d');
        $factura->idEmisor = $request->idEmisor;
        $factura->idComprador = $request->idComprador;
        $factura->valorFactura = $request->valorFactura;
        $factura->iva = $request->iva;
        $factura->valorFinal = $request->valorFinal;
        $factura->save();


        foreach ($request->productos as $producto) {

            $detalleFactura = new Detallefactura();
            $detalleFactura->idDetalleFactura = $factura->id;
            $detalleFactura->idProducto = $producto['idProducto'];
            $detalleFactura->cantidadProducto = $producto['cantidadProducto'];
            $detalleFactura->valorUnitario = $producto['valorUnitario'];
            $detalleFactura->valorTotal = $producto['valorTotal'];
            $detalleFactura->save();
        }
        

        return $factura;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
