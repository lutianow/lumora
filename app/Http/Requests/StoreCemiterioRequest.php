<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCemiterioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255|unique:cemiterio,nome',
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:2|regex:/^[A-Z]{2}$/',
            'cep' => 'required|string|max:20|regex:/^\d{5}-?\d{3}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do cemitério é obrigatório.',
            'nome.unique' => 'Este cemitério já existe.',
            'endereco.required' => 'O endereço é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',
            'estado.regex' => 'O estado deve ser uma sigla com 2 letras maiúsculas (ex: SP).',
            'cep.regex' => 'O CEP deve estar no formato 12345-678.',
        ];
    }
}
