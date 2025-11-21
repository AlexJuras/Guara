<?php

namespace App\Filament\Resources\Contas\Widgets;

use Filament\Widgets\ChartWidget;

class Grafico extends ChartWidget
{
    protected ?string $heading = 'Grafico';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
