<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcessibilidadesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoria' => 'required|unique:acessibilidades,categoria,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'categoria.required'    => 'O campo e categoria é de preenchimento obrigatorio!',
            'categoria.unique'      => 'A categoria já existe!'
        ];
    }
}
