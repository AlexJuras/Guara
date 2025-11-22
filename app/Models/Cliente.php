<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 
        'razao_social', 
        'cnpj',
        'tipo_cliente',
        'contato_responsavel',
        'endereco',
        'status',
        'data_inicio_contrato',
        'data_fim_contrato',
    ];

    protected $casts = [
        'data_inicio_contrato' => 'date:d/m/Y',
        'data_fim_contrato' => 'date:d/m/Y',
    ];

    // Accessor para formatar CNPJ
    public function getCnpjFormatadoAttribute()
    {
        if (!$this->cnpj) return null;
        
        return preg_replace(
            '/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/',
            '$1.$2.$3/$4-$5',
            $this->cnpj
        );
    }

    // Mutator para limpar CNPJ (remove pontuação)
    public function setCnpjAttribute($value)
    {
        $this->attributes['cnpj'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Scopes para filtros comuns
    public function scopeAtivos($query)
    {
        return $query->where('status', true);
    }

    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_cliente', $tipo);
    }
    
}
