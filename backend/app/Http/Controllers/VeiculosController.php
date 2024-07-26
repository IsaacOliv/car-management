<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class VeiculosController extends Controller
{
    public function get()
    {
        return Veiculo::select('id', 'id_acessibilidade', 'dataAquisicao', 'modelo', 'placa')
            ->with('acessibilidade')
            ->orderBy('dataAquisicao')
            ->orderBy('modelo')
            ->get();
    }

    public function post(Request $request)
    {
        try {
            $request->validate([
                'dataAquisicao'     => 'required|before_or_equal:tomorrow',
                'modelo'            => 'required',
                'placa'             => 'required|unique:veiculos',
                'id_acessibilidade' => 'integer',
            ], [
                'dataAquisicao.before_or_equal'      => 'A data de aquisição não pode ser superior ao dia de hoje!',
                'dataAquisicao.required'            => 'O campo Data de aquisição é de preenchimento obrigatorio!',
                'modelo.required'                   => 'O campo de Modelo é de preenchimento obrigatorio!',
                'placa.required'                    => 'O campo Placa é de preenchimento obrigatorio!',
                'placa.unique'                      => 'A placa informada já existe!',
            ]);

            $acessibilidade = $request->id_acessibilidade == 0 ? null : $request->id_acessibilidade;

            $criar = Veiculo::create([
                'id_acessibilidade' => $acessibilidade,
                'dataAquisicao'     => $request->dataAquisicao,
                'modelo'            => $request->modelo,
                'placa'             => $request->placa,
            ]);
            if (!$criar) {
            return response()->json(['msg' => 'Não foi possivel cadastrar o veiculo!'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['msg' => 'Veiculo cadastrado com sucesso!'], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function edit($id)
    {
        return Veiculo::findOrFail($id);
    }

    public function put(Request $request, $id)
    {
        try {
            $request->validate([
                'dataAquisicao'     => 'required|before_or_equal:tomorrow',
                'modelo'            => 'required',
                'placa'             => 'required|unique:veiculos,placa,' . $id,
            ], [
                'dataAquisicao.before_or_equal'     => 'A data de aquisição não pode ser superior ao dia de hoje!',
                'dataAquisicao.required'            => 'O campo Data de aquisição é de preenchimento obrigatorio!',
                'modelo.required'                   => 'O campo de Modelo é de preenchimento obrigatorio!',
                'placa.required'                    => 'O campo Placa é de preenchimento obrigatorio!',
                'placa.unique'                      => 'A placa informada já existe!',
            ]);

            $veiculo = Veiculo::find($id);
            if (!$veiculo) {
            return response()->json(['msg' => 'Não foi possivel encontrar o veiculo selecionado!!'], Response::HTTP_NOT_FOUND);
            }

            $acessibilidade = $request->id_acessibilidade == 0 ? null : $request->id_acessibilidade;

            $update = $veiculo->update([
                'id_acessibilidade' => $acessibilidade,
                'dataAquisicao'     => $request->dataAquisicao,
                'modelo'            => $request->modelo,
                'placa'             => $request->placa,
            ]);
            if (!$update) {
            return response()->json(['msg' => 'Não foi possivel editar o veiculo!'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['msg' => 'Veiculo atualizado com sucesso!'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            $veiculo = Veiculo::find($id);
            if (!$veiculo) {
                return response()->json(['msg' => 'Não foi possivel localizar o veiculo selecionado!'], Response::HTTP_NOT_FOUND);
            }
            $deleta = $veiculo->delete();
            if (!$deleta) {
                return response()->json(['msg' => 'Não foi possivel excluir o veiculo selecionado!'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json(['msg' => 'Veiculo excluido com sucesso!'], Response::HTTP_NO_CONTENT);
        } catch (\Exception $ex) {
            return response()->json(['msg' => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
