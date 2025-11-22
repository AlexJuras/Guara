<?php

namespace App\Filament\Resources\Contas\Pages;

use App\Filament\Resources\Contas\ContaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConta extends CreateRecord
{
    protected static string $resource = ContaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Associa a conta ao usuário logado
        $data['user_id'] = auth()->id();
        
        return $data;
    }
}
