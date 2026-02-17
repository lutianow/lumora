<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSepultamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jazigo_id' => 'sometimes|required|exists:jazigo,id',
            'nome_falecido' => 'sometimes|required|string|max:255',
            'data_nascimento' => 'nullable|date|before:data_falecimento',
            'data_falecimento' => 'sometimes|required|date|before_or_equal:today',
            'observacoes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'jazigo_id.exists' => 'O jazigo selecionado não existe.',
            'nome_falecido.required' => 'O nome do falecido é obrigatório.',
            'data_nascimento.before' => 'A data de nascimento deve ser anterior à data de falecimento.',
            'data_falecimento.before_or_equal' => 'A data de falecimento não pode ser no futuro.',
        ];
    }
}
