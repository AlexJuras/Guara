<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SaldoStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $saldo = $user ? $user->saldo : 0;
        
        return [
            Stat::make('Saldo Atual', 'R$ ' . number_format((float) $saldo, 2, ',', '.'))
                ->description('Seu saldo disponível')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color($saldo >= 0 ? 'success' : 'danger')
                ->chart($saldo >= 0 ? [7, 2, 10, 3, 15, 4, 17] : [17, 16, 14, 15, 14, 13, 12]),
        ];
    }
}
