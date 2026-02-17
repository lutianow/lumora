<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cemiterio extends Model
{
    use HasFactory;

    protected $table = 'cemiterio';

    protected $fillable = [
        'nome',
        'endereco',
        'cidade',
        'estado',
        'cep',
    ];

    // Relacionamento com Quadra
    public function quadras()
    {
        return $this->hasMany(Quadra::class);
    }
}
