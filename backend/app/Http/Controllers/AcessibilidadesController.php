<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcessibilidadesController extends Controller
{
    public function get()
    {
        return json_encode('acessibilidade');
    }
}
