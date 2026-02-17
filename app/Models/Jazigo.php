<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jazigo extends Model
{
    use HasFactory;

    protected $table = 'jazigo';

    protected $fillable = [
        'quadra_id',
        'numero',
        'tipo',
        'disponivel',
    ];

    // Relacionamento com Quadra
    public function quadra()
    {
        return $this->belongsTo(Quadra::class);
    }

    // Relacionamento com Sepultamento
    public function sepultamentos()
    {
        return $this->hasMany(Sepultamento::class);
    }
}
