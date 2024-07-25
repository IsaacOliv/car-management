<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeiculosController extends Controller
{
    public function get()
    {
        return \App\Models\veiculos::get();
    }
}
