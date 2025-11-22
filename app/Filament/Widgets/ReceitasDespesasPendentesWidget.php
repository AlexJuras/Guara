<?php

namespace App\Filament\Widgets;

use App\Models\Conta;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ReceitasDespesasPendentesWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    
    protected function getHeading(): string
    {
        return 'RECEITAS';
    }
    
    protected function getStats(): array
    {
        $userId = auth()->id();
        $currentMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Calculate pending receitas for current month
        $receitasPendentes = Conta::where('user_id', $userId)
            ->where('tipo', 'receita')
            ->where('status', 'pendente')
            ->whereBetween('data_vencimento', [$currentMonth, $endOfMonth])
            ->sum('valor');

        // Calculate receitas pagas no mês
        $receitasPagas = Conta::where('user_id', $userId)
            ->where('tipo', 'receita')
            ->where('status', 'pago')
            ->whereBetween('data_pagamento', [$currentMonth, $endOfMonth])
            ->sum('valor');
        
        // Total de receitas (pagas + pendentes)
        $totalReceitas = $receitasPendentes + $receitasPagas;
        
        return [
            Stat::make('A Receber', 'R$ ' . number_format($receitasPendentes, 2, ',', '.'))
                ->description('Receitas pendentes no mês')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            
            Stat::make('Recebidas', 'R$ ' . number_format($receitasPagas, 2, ',', '.'))
                ->description('Receitas pagas no mês')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success'),
            
            Stat::make('Total do Mês', 'R$ ' . number_format($totalReceitas, 2, ',', '.'))
                ->description('Total de receitas (pagas + pendentes)')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
