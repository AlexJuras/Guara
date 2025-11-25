<?php

namespace App\Filament\Resources\Cadastros;

use App\Filament\Resources\Cadastros\Pages\CreateCadastro;
use App\Filament\Resources\Cadastros\Pages\EditCadastro;
use App\Filament\Resources\Cadastros\Pages\ListCadastros;
use App\Filament\Resources\Cadastros\Pages\ViewCadastro;
use App\Filament\Resources\Cadastros\Schemas\CadastroForm;
use App\Filament\Resources\Cadastros\Schemas\CadastroInfolist;
use App\Filament\Resources\Cadastros\Tables\CadastrosTable;
use App\Models\Cadastro;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CadastroResource extends Resource
{
    protected static ?string $model = Cadastro::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    
    protected static ?string $navigationLabel = 'Cadastros';
    
    protected static ?string $modelLabel = 'Cadastro';
    
    protected static ?string $pluralModelLabel = 'Cadastros';

    public static function form(Schema $schema): Schema
    {
        return CadastroForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CadastroInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CadastrosTable::configure($table);
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
            'index' => ListCadastros::route('/'),
            'create' => CreateCadastro::route('/create'),
            'view' => ViewCadastro::route('/{record}'),
            'edit' => EditCadastro::route('/{record}/edit'),
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
