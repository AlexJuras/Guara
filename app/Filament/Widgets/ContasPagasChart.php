<?php

namespace App\Filament\Widgets;

use App\Models\Conta;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ContasPagasChart extends StatsOverviewWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    
    protected function getHeading(): string
    {
        return 'DESPESAS';
    }
    
    protected function getStats(): array
    {
        $userId = auth()->id();
        $currentMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Busca total de despesas pendentes no mês
        $despesasPendentes = Conta::where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pendente')
            ->whereBetween('data_vencimento', [$currentMonth, $endOfMonth])
            ->sum('valor');
        
        // Busca total de despesas pagas no mês
        $despesasPagas = Conta::where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pago')
            ->whereBetween('data_pagamento', [$currentMonth, $endOfMonth])
            ->sum('valor');

        // Total de despesas (pagas + pendentes)
        $totalDespesas = $despesasPendentes + $despesasPagas;
        
        return [
            Stat::make('A Pagar', 'R$ ' . number_format($despesasPendentes, 2, ',', '.'))
                ->description('Despesas pendentes no mês')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            
            Stat::make('Pagas', 'R$ ' . number_format($despesasPagas, 2, ',', '.'))
                ->description('Despesas pagas no mês')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('danger'),
            
            Stat::make('Total do Mês', 'R$ ' . number_format($totalDespesas, 2, ',', '.'))
                ->description('Total de despesas (pagas + pendentes)')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('info'),
        ];
    }
}
