<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'estado',
        'cidade',
        'endereco',
        'contrato',
        'sla'
    ];

    protected $casts = [
        'sla' => 'array',
    ];
}
