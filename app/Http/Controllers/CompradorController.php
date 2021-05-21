<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use Illuminate\Http\Request;

class CompradorController extends Controller
{
    //
    public function index(){
        return Comprador::all();
    }
}
