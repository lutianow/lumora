<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJazigoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jazigoId = $this->jazigo->id;
        $quadraId = request('quadra_id') ?? $this->jazigo->quadra_id;

        return [
            'quadra_id' => 'sometimes|required|exists:quadra,id',
            'numero' => 'sometimes|required|string|max:50|unique:jazigo,numero,' . $jazigoId . ',id,quadra_id,' . $quadraId,
            'tipo' => 'sometimes|required|string|in:simples,duplo,triplo,cripta',
            'disponivel' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'quadra_id.exists' => 'A quadra selecionada não existe.',
            'numero.unique' => 'Este número já existe nesta quadra.',
            'tipo.in' => 'O tipo deve ser: simples, duplo, triplo ou cripta.',
        ];
    }
}
