<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{
    public function get()
    {
        return Veiculo::get();
    }
}
