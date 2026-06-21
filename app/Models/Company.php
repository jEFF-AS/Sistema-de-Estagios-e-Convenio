<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    // 1. NOME DA TABELA
    protected $table = "companies";

    // @2. CAMPOS PERMITIDOS
    // Permissão para o Livewire gravar dados nessas colunas
    protected $fillable = [
        'name',
        'trading_name',
        'cnpj',
        'representative',
        'phone',
        'relationship_start_date',
        'relationship_end_date',
        'courses',
        'status',
        'observations',
    ];

    // 3. CONVERSÃO TIPOS (CAST)
    protected $casts = [
        'courses' => 'array',
        'relationship_start_date' => 'date',
        'relationship_end_date' => 'date', 
    ];
}
