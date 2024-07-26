<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculosRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dataAquisicao' => 'required|before_or_equal:tomorrow',
            'modelo'        => 'required',
            'placa'         => 'required|unique:veiculos,placa,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'dataAquisicao.before_or_equal' => 'A data de aquisição não pode ser superior ao dia de hoje!',
            'dataAquisicao.required'        => 'O campo Data de aquisição é de preenchimento obrigatorio!',
            'modelo.required'               => 'O campo de Modelo é de preenchimento obrigatorio!',
            'placa.required'                => 'O campo Placa é de preenchimento obrigatorio!',
            'placa.unique'                  => 'A placa informada já existe!',
        ];
    }
}
