<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quadra extends Model
{
    use HasFactory;

    protected $table = 'quadra';

    protected $fillable = [
        'cemiterio_id',
        'nome',
        'descricao',
    ];

    // Relacionamento com Cemiterio
    public function cemiterio()
    {
        return $this->belongsTo(Cemiterio::class);
    }
}
