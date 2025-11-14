<?php

namespace App\Filament\Resources\Contas\Pages;

use App\Filament\Resources\Contas\ContaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConta extends ViewRecord
{
    protected static string $resource = ContaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
