<?php

namespace App\Filament\Resources\Donos\Pages;

use App\Filament\Resources\Donos\DonoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDono extends ViewRecord
{
    protected static string $resource = DonoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
