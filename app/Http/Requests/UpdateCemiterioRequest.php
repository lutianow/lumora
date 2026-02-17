<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCemiterioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'sometimes|required|string|max:255|unique:cemiterio,nome,' . $this->cemiterio->id,
            'endereco' => 'sometimes|required|string|max:255',
            'cidade' => 'sometimes|required|string|max:100',
            'estado' => 'sometimes|required|string|max:2|regex:/^[A-Z]{2}$/',
            'cep' => 'sometimes|required|string|max:20|regex:/^\d{5}-?\d{3}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.unique' => 'Este cemitério já existe.',
            'estado.regex' => 'O estado deve ser uma sigla com 2 letras maiúsculas (ex: SP).',
            'cep.regex' => 'O CEP deve estar no formato 12345-678.',
        ];
    }
}
