<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuadraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cemiterio_id' => 'required|exists:cemiterio,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'cemiterio_id.required' => 'O cemitério é obrigatório.',
            'cemiterio_id.exists' => 'O cemitério selecionado não existe.',
            'nome.required' => 'O nome da quadra é obrigatório.',
        ];
    }
}
