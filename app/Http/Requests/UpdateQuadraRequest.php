<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuadraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cemiterio_id' => 'sometimes|required|exists:cemiterio,id',
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'cemiterio_id.exists' => 'O cemitério selecionado não existe.',
            'nome.required' => 'O nome da quadra é obrigatório.',
        ];
    }
}
