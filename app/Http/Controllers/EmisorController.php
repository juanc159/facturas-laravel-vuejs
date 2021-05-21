<?php

namespace App\Http\Controllers;

use App\Models\Emisor;
use Illuminate\Http\Request;

class EmisorController extends Controller
{
    //
    public function index(){
        return Emisor::all();
    }
}
