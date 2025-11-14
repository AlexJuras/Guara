<?php

namespace App\Filament\Resources\Contas;

use App\Filament\Resources\Contas\Pages\CreateConta;
use App\Filament\Resources\Contas\Pages\EditConta;
use App\Filament\Resources\Contas\Pages\ListContas;
use App\Filament\Resources\Contas\Pages\ViewConta;
use App\Filament\Resources\Contas\Schemas\ContaForm;
use App\Filament\Resources\Contas\Schemas\ContaInfolist;
use App\Filament\Resources\Contas\Tables\ContasTable;
use App\Models\Conta;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContaResource extends Resource
{
    protected static ?string $model = Conta::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ContaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContas::route('/'),
            'create' => CreateConta::route('/create'),
            'view' => ViewConta::route('/{record}'),
            'edit' => EditConta::route('/{record}/edit'),
        ];
    }
}
