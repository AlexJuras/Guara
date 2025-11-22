<?php

namespace App\Filament\Resources\Contas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ContasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('user.name')
                    ->label('Criado por')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('dono.nome')
                    ->label('Dono')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('nome')
                    ->label('Nome')
                    ->limit(30)
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'receita' => 'success',
                        'despesa' => 'danger',
                        'transferencia' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'receita' => 'Receita',
                        'despesa' => 'Despesa',
                        'transferencia' => 'Transferência',
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('categoria')
                    ->label('Categoria')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('valor')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),
                
                TextColumn::make('saldo')
                    ->label('Saldo')
                    ->money('BRL')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pago' => 'success',
                        'pendente' => 'warning',
                        'parcial' => 'info',
                        'cancelado' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pago' => 'Pago',
                        'pendente' => 'Pendente',
                        'parcial' => 'Parcial',
                        'cancelado' => 'Cancelado',
                        default => $state,
                    })
                    ->sortable(),
                
                TextColumn::make('data_vencimento')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                
                TextColumn::make('data_pagamento')
                    ->label('Pago em')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('contaRecorrenteMae.nome')
                    ->label('Série Recorrente')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-arrow-path')
                    ->placeholder('Conta única')
                    ->tooltip(fn ($record) => $record->conta_recorrente_id 
                        ? 'Esta conta faz parte de uma série recorrente' 
                        : 'Esta é uma conta única')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('recorrencia_tipo')
                    ->label('Tipo Recorrência')
                    ->badge()
                    ->color('purple')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'diaria' => 'Diária',
                        'semanal' => 'Semanal',
                        'mensal' => 'Mensal',
                        'anual' => 'Anual',
                        default => '-'
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                
                IconColumn::make('recorrente')
                    ->label('Recorrente')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('metodo_pagamento')
                    ->label('Método')
                    ->toggleable(isToggledHiddenByDefault: true),
                                
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('data_vencimento', 'desc');
    }
}
