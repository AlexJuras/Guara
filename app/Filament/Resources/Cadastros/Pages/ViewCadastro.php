<?php

namespace App\Filament\Resources\Cadastros\Pages;

use App\Filament\Resources\Cadastros\CadastroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCadastro extends ViewRecord
{
    protected static string $resource = CadastroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
