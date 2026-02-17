<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJazigoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quadra_id' => 'required|exists:quadra,id',
            'numero' => 'required|string|max:50|unique:jazigo,numero,NULL,id,quadra_id,' . request('quadra_id'),
            'tipo' => 'required|string|in:simples,duplo,triplo,cripta',
            'disponivel' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'quadra_id.required' => 'A quadra é obrigatória.',
            'quadra_id.exists' => 'A quadra selecionada não existe.',
            'numero.required' => 'O número do jazigo é obrigatório.',
            'numero.unique' => 'Este número já existe nesta quadra.',
            'tipo.required' => 'O tipo de jazigo é obrigatório.',
            'tipo.in' => 'O tipo deve ser: simples, duplo, triplo ou cripta.',
        ];
    }
}
