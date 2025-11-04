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
        'cliente_id',
        'valor',
        'tipo_movimentacao',
        'tipo_pagamento',
        'status',
        'data_vencimento',
        'data_pagamento',
        'descricao',
    ];

    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'valor' => 'decimal:2',
    ];

    // Relacionamentos
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
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
