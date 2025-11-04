<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conta;

class Parcela extends Model
{
    /** @use HasFactory<\Database\Factories\ParcelaFactory> */
    use HasFactory;

    protected $table = 'parcelas';

    protected $fillable = [
        'conta_id',
        'valor',
        'data_vencimento',
        'data_pagamento',
        'status',
        'numero_parcela',
    ];

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
