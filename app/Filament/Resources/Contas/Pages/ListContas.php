<?php

namespace App\Filament\Resources\Contas\Pages;

use App\Filament\Resources\Contas\ContaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContas extends ListRecords
{
    protected static string $resource = ContaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
