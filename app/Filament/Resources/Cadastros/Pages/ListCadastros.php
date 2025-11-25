<?php

namespace App\Filament\Resources\Cadastros\Pages;

use App\Filament\Resources\Cadastros\CadastroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCadastros extends ListRecords
{
    protected static string $resource = CadastroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
