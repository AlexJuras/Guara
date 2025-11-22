<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcela;

class Conta extends Model
{
    /** @use HasFactory<\Database\Factories\ContaFactory> */
    use HasFactory;

    protected $table = 'contas';

    protected $fillable = [
        'user_id',
        'dono_id',
        'nome',
        'tipo',
        'categoria',
        'valor',
        'saldo',
        'status',
        'data_vencimento',
        'data_pagamento',
        'recorrente',
        'recorrencia_tipo',
        'recorrencia_repeticoes',
        'conta_recorrente_id',
        'metodo_pagamento',
        'descricao',
        'tipo_movimentacao',
        'tipo_pagamento',
    ];

    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'valor' => 'decimal:2',
        'saldo' => 'decimal:2',
        'recorrente' => 'boolean',
        'recorrencia_repeticoes' => 'integer',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function dono()
    {
        return $this->belongsTo(Dono::class);
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }

    // Relacionamento com conta recorrente mãe
    public function contaRecorrenteMae()
    {
        return $this->belongsTo(Conta::class, 'conta_recorrente_id');
    }

    // Relacionamento com contas recorrentes filhas
    public function contasRecorrentes()
    {
        return $this->hasMany(Conta::class, 'conta_recorrente_id');
    }

    // Scopes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    public function scopePagas($query)
    {
        return $query->where('status', 'pago');
    }

    public function scopeReceber($query)
    {
        return $query->where('tipo_movimentacao', 'receber');
    }

    public function scopePagar($query)
    {
        return $query->where('tipo_movimentacao', 'pagar');
    }

    // Accessors
    public function getValorFormatadoAttribute()
    {
        return 'R$ ' . number_format((float) $this->valor, 2, ',', '.');
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pendente' => 'yellow',
            'pago' => 'green',
            'atrasado' => 'red',
            'cancelado' => 'gray',
            default => 'blue'
        };
    }
}
