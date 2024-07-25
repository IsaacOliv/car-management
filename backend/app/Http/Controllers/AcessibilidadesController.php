<?php

namespace App\Http\Controllers;

use App\Models\Acessibilidade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AcessibilidadesController extends Controller
{
    public function get()
    {
        return Acessibilidade::select('id', 'categoria')->orderBy('categoria')->get();
    }

    public function post(Request $request)
    {
        try {
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
                throw new \Exception('Não foi possivel cadastrar a categoria!');
            }

            return response()->json(['msg' => 'Categoria cadastrada com sucesso!'], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    public function put(Request $request)
    {
        session('update', $request->id_categoria);
        dd(session('update'));
    }
}
