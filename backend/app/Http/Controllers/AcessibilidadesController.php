<?php

namespace App\Http\Controllers;

use App\Models\Acessibilidade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcessibilidadesController extends Controller
{
    public function get()
    {
        return json_encode('acessibilidade');
    }

    public function post(Request $request)
    {
        $request->validate([
            'categoria' => 'required|unique:acessibilidades'
        ],[
            'categoria.required'    => 'O campo e categoria é de preenchimento obrigatorio!',
            'categoria.unique'      => 'A categoria já existe!'
        ]);

        $criar = Acessibilidade::create([
            'categoria' => $request->categoria
        ]);
        if (!$criar) {
            return response()->json(['msg' => 'Não foi possivel cadastrar a categoria!'], 404);
        }
        return response()->json(['msg' => 'Categoria cadastrada com sucesso!'], Response::HTTP_CREATED);
    }
}
