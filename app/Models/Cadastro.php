<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cadastro extends Model
{
    /** @use HasFactory<\Database\Factories\CadastroFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'cadastros';

    protected $fillable = [
        'foto',
        'nome',
        'tipo',
        'cpf_cnpj',
        'email',
        'telefone',
        'whatsapp',
        'endereco',
        'categoria',
        'ativo',
        'saldo_total',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'saldo_total' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];

    protected $attributes = [
        'ativo' => true,
        'saldo_total' => 0,
    ];

    public function contas(): HasMany
    {
        return $this->hasMany(Conta::class, 'cadastro_id');
    }
}
