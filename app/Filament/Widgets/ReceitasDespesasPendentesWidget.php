<?php

namespace App\Filament\Widgets;

use App\Models\Conta;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReceitasDespesasPendentesWidget extends StatsOverviewWidget
{
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

        // Calculate pending despesas for current month
        $despesasPendentes = Conta::where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pendente')
            ->whereBetween('data_vencimento', [$currentMonth, $endOfMonth])
            ->sum('valor');

        return [
            Stat::make('Receitas Pendentes', 'R$ ' . number_format($receitasPendentes, 2, ',', '.'))
                ->description('Total de receitas pendentes no mês')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Despesas Pendentes', 'R$ ' . number_format($despesasPendentes, 2, ',', '.'))
                ->description('Total de despesas pendentes no mês')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
