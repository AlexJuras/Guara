<?php

namespace App\Filament\Resources\Donos\Pages;

use App\Filament\Resources\Donos\DonoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonos extends ListRecords
{
    protected static string $resource = DonoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
