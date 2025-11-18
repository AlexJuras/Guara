<?php

namespace App\Filament\Resources\Contas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('dono_id')
                    ->label('Dono da Conta')
                    ->relationship('dono', 'nome')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('nome')
                            ->required()
                            ->maxLength(255),
                        Select::make('tipo')
                            ->options([
                                'cliente' => 'Cliente',
                                'fornecedor' => 'Fornecedor',
                                'prestador_servico' => 'Prestador de Serviço',
                                'outros' => 'Outros',
                            ])
                            ->default('outros')
                            ->required(),
                    ])
                    ->helperText('Selecione ou crie um novo dono para esta conta'),
                
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                
                Select::make('tipo')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'receita' => 'Receita',
                        'despesa' => 'Despesa',
                        'transferencia' => 'Transferência',
                    ])
                    ->native(false),
                
                TextInput::make('categoria')
                    ->label('Categoria')
                    ->maxLength(100)
                    ->placeholder('Ex: Aluguel, Serviços, Vendas...'),
                
                TextInput::make('valor')
                    ->label('Valor')
                    ->required()
                    ->numeric()
                    ->prefix('R$')
                    ->step(0.01)
                    ->minValue(0),
                
                TextInput::make('saldo')
                    ->label('Saldo')
                    ->numeric()
                    ->prefix('R$')
                    ->step(0.01)
                    ->default(0)
                    ->helperText('Valor restante a pagar/receber'),
                
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pendente' => 'Pendente',
                        'pago' => 'Pago',
                        'parcial' => 'Parcial',
                        'cancelado' => 'Cancelado',
                    ])
                    ->default('pendente')
                    ->native(false),
                
                DatePicker::make('data_vencimento')
                    ->label('Data de Vencimento')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                
                DatePicker::make('data_pagamento')
                    ->label('Data de Pagamento')
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                
                Toggle::make('recorrente')
                    ->label('Conta Recorrente')
                    ->default(false)
                    ->helperText('Marque se esta conta se repete mensalmente'),
                
                Select::make('metodo_pagamento')
                    ->label('Método de Pagamento')
                    ->options([
                        'dinheiro' => 'Dinheiro',
                        'cartao_credito' => 'Cartão de Crédito',
                        'cartao_debito' => 'Cartão de Débito',
                        'pix' => 'PIX',
                        'boleto' => 'Boleto',
                        'transferencia' => 'Transferência Bancária',
                        'cheque' => 'Cheque',
                        'outro' => 'Outro',
                    ])
                    ->native(false),
                
                Textarea::make('descricao')
                    ->label('Descrição / Observações')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull(),
            ]);
    }
}
