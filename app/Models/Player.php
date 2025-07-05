<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sobrenome',
        'posicao',
        'numero_camisa',
        'nacionalidade',
        'data_nascimento',
        'descricao',
        'foto',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}
