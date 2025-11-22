<?php

namespace App\Filament\Resources\Donos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DonoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->directory('donos')
                    ->maxSize(2048)
                    ->columnSpanFull(),
                
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                Select::make('tipo')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'cliente' => 'Cliente',
                        'fornecedor' => 'Fornecedor',
                        'prestador_servico' => 'Prestador de Serviço',
                        'outros' => 'Outros',
                    ])
                    ->default('outros')
                    ->native(false),
                
                TextInput::make('categoria')
                    ->label('Categoria')
                    ->maxLength(255)
                    ->placeholder('Ex: Padaria, Diarista, TI...'),
                
                TextInput::make('cpf_cnpj')
                    ->label('CPF/CNPJ')
                    ->maxLength(18)
                    ->unique(ignoreRecord: true)
                    ->placeholder('000.000.000-00 ou 00.000.000/0000-00'),
                
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->maxLength(255),
                
                TextInput::make('telefone')
                    ->label('Telefone')
                    ->tel()
                    ->placeholder('(00) 0000-0000')
                    ->maxLength(20),
                
                TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->placeholder('(00) 00000-0000')
                    ->maxLength(20),
                
                Textarea::make('endereco')
                    ->label('Endereço Completo')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),
                
                Toggle::make('ativo')
                    ->label('Ativo')
                    ->default(true)
                    ->inline(false),
            ])
            ->columns(2);
    }
}
