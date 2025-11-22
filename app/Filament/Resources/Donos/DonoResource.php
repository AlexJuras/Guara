<?php

namespace App\Filament\Resources\Donos;

use App\Filament\Resources\Donos\Pages\CreateDono;
use App\Filament\Resources\Donos\Pages\EditDono;
use App\Filament\Resources\Donos\Pages\ListDonos;
use App\Filament\Resources\Donos\Pages\ViewDono;
use App\Filament\Resources\Donos\Schemas\DonoForm;
use App\Filament\Resources\Donos\Schemas\DonoInfolist;
use App\Filament\Resources\Donos\Tables\DonosTable;
use App\Models\Dono;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonoResource extends Resource
{
    protected static ?string $model = Dono::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    
    protected static ?string $navigationLabel = 'Donos';
    
    protected static ?string $modelLabel = 'Dono';
    
    protected static ?string $pluralModelLabel = 'Donos';

    public static function form(Schema $schema): Schema
    {
        return DonoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DonoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonosTable::configure($table);
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
            'index' => ListDonos::route('/'),
            'create' => CreateDono::route('/create'),
            'view' => ViewDono::route('/{record}'),
            'edit' => EditDono::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
