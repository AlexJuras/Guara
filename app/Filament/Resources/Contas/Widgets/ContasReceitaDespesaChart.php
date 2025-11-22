<?php

namespace App\Filament\Resources\Contas\Widgets;

use App\Models\Conta;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ContasReceitaDespesaChart extends ChartWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    
    public ?string $filter = null;
    
    public function getHeading(): ?string
    {
        return 'Receitas vs Despesas Pendentes';
    }

    protected function getData(): array
    {
        $now = Carbon::now();
        
        // Se não houver filtro, usa o mês atual
        $month = $this->filter ?? $now->month;
        
        // Define início e fim do mês selecionado
        $startDate = Carbon::create($now->year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($now->year, $month, 1)->endOfMonth();
        
        // Número de dias no mês
        $daysInMonth = $startDate->daysInMonth;
        
        // Arrays para armazenar os dados por dia
        $receitasPorDia = [];
        $despesasPorDia = [];
        $labels = [];
        
        // Itera sobre cada dia do mês
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labels[] = $day;
            
            $dataAtual = Carbon::create($now->year, $month, $day);
            
            // Busca receitas pendentes do dia do usuário logado
            $receitas = Conta::where('user_id', auth()->id())
                ->where('tipo', 'receita')
                ->where('status', 'pendente')
                ->whereDate('data_vencimento', $dataAtual)
                ->sum('valor');
            
            // Busca despesas pendentes do dia do usuário logado
            $despesas = Conta::where('user_id', auth()->id())
                ->where('tipo', 'despesa')
                ->where('status', 'pendente')
                ->whereDate('data_vencimento', $dataAtual)
                ->sum('valor');
            
            $receitasPorDia[] = (float) $receitas;
            $despesasPorDia[] = (float) $despesas;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Receitas Pendentes',
                    'data' => $receitasPorDia,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'borderColor' => 'rgb(16, 185, 129)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Despesas Pendentes',
                    'data' => $despesasPorDia,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    
    protected function getFilters(): ?array
    {
        return [
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];
    }
    
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "R$ " + value.toLocaleString("pt-BR", {minimumFractionDigits: 2}); }',
                    ],
                ],
            ],
        ];
    }
}
