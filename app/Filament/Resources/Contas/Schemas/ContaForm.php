<?php

namespace App\Filament\Resources\Contas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class ContaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cadastro_id')
                    ->label('Cadastro da Conta')
                    ->relationship('cadastro', 'nome')
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
                    ->helperText('Selecione ou crie um novo cadastro para esta conta'),
                
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
                    ->native(false)
                    ->live(),
                
                DatePicker::make('data_vencimento')
                    ->label('Data de Vencimento')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                
                DatePicker::make('data_pagamento')
                    ->label('Data de Pagamento')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Preenchido automaticamente quando a conta é marcada como paga'),
                
                Toggle::make('recorrente')
                    ->label('Conta Recorrente')
                    ->default(false)
                    ->helperText('Marque se esta conta se repete periodicamente')
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!$state) {
                            $set('recorrencia_tipo', null);
                            $set('recorrencia_repeticoes', null);
                        }
                    }),
                
                Select::make('recorrencia_tipo')
                    ->label('Tipo de Recorrência')
                    ->options([
                        'diaria' => 'Diária',
                        'semanal' => 'Semanal',
                        'mensal' => 'Mensal',
                        'anual' => 'Anual',
                    ])
                    ->native(false)
                    ->required(fn ($get) => $get('recorrente'))
                    ->visible(fn ($get) => $get('recorrente'))
                    ->helperText('Com que frequência esta conta se repete?'),
                
                TextInput::make('recorrencia_repeticoes')
                    ->label('Número de Repetições')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(999)
                    ->default(12)
                    ->required(fn ($get) => $get('recorrente'))
                    ->visible(fn ($get) => $get('recorrente'))
                    ->helperText('Quantas vezes esta conta irá se repetir? (incluindo a primeira)'),
                
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
                
                FileUpload::make('anexos')
                    ->label('Anexos')
                    ->multiple()
                    ->directory('contas/anexos')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(5120)
                    ->downloadable()
                    ->openable()
                    ->previewable()
                    ->helperText('Anexe comprovantes, notas fiscais ou outros documentos (PDF ou imagens, máx. 5MB cada)')
                    ->columnSpanFull(),
            ]);
    }
}
