<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepultamento extends Model
{
    use HasFactory;

    protected $table = 'sepultamento';

    protected $fillable = [
        'jazigo_id',
        'nome_falecido',
        'data_nascimento',
        'data_falecimento',
        'observacoes',
    ];

    // Relacionamento com Jazigo
    public function jazigo()
    {
        return $this->belongsTo(Jazigo::class);
    }

    // Acessar Quadra através de Jazigo
    public function getQuadraAttribute()
    {
        return $this->jazigo?->quadra;
    }

    // Acessar Cemiterio através de Jazigo->Quadra
    public function getCemiterioAttribute()
    {
        return $this->jazigo?->quadra?->cemiterio;
    }
}
