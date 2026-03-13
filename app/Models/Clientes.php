<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'parent_id',
        'tipo',
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

    // Relacionamento: Pega todas as unidades de um ministério
    public function unidades()
    {
        return $this->hasMany(Clientes::class, 'parent_id');
    }

    // Relacionamento: Pega o ministério ao qual uma unidade pertence
    public function pai()
    {
        return $this->belongsTo(Clientes::class, 'parent_id');
    }
}