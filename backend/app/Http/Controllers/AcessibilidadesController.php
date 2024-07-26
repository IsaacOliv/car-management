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
            ], [
                'categoria.required'    => 'O campo e categoria é de preenchimento obrigatorio!',
                'categoria.unique'      => 'A categoria já existe!'
            ]);

            $criar = Acessibilidade::create([
                'categoria' => $request->categoria
            ]);
            if (!$criar) {
                return response()->json(['msg' => 'Não foi possivel cadastrar a categoria!'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(['msg' => 'Categoria cadastrada com sucesso!'], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function edit($id)
    {
        $acessibilidade = Acessibilidade::findOrFail($id);
        if (!$acessibilidade) {
            return response()->json(['msg' => 'Não foi possivel localizar a acessiblidade selecionada!'], Response::HTTP_NOT_FOUND);
        }
        return $acessibilidade;
    }

    public function put(Request $request, $id)
    {
        try {
            $request->validate([
                'categoria' => 'required|unique:acessibilidades,categoria,'.$id
            ], [
                'categoria.required'    => 'O campo e categoria é de preenchimento obrigatorio!',
                'categoria.unique'      => 'A categoria já existe!'
            ]);

            $acessibilidade = Acessibilidade::find($id);
            if (!$acessibilidade) {
                return response()->json(['msg' => 'Não foi possivel localizar a acessiblidade!'], Response::HTTP_NOT_FOUND);
            }
            $update = $acessibilidade->update([
                'categoria' => $request->categoria
            ]);
            if (!$update) {
                return response()->json(['msg' => 'Não foi possivel atualizar a acessibilidade!'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['msg' => 'Acessibilidade atualizada com sucesso!'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $acessibilidade = Acessibilidade::with('veiculos')->find($id);
            if (!$acessibilidade) {
                return response()->json(['msg' => 'Não foi possivel localizar a acessiblidade!'], Response::HTTP_NOT_FOUND);
            }
            if (count($acessibilidade->veiculos) > 0) {
                return response()->json(['msg' => 'Não é possivel excluir uma acessibilidade que está vinculada a um veiculo!'], Response::HTTP_CONFLICT);
            }
            $acessibilidade->delete();
            return response()->json(['msg' => 'Acessibilidade excluida com sucesso!'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
