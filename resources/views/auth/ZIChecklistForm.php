<?php

namespace App\Filament\Resources\ZIChecklists\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ZIChecklistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('aspek')
                    ->required(),
                TextInput::make('area')
                    ->required(),
                TextInput::make('pilar')
                    ->required(),
                TextInput::make('sub_pilar'),
                Textarea::make('pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('google_drive_folder_id'),
                Select::make('status')
                    ->options(['Kosong' => 'Kosong', 'Terisi' => 'Terisi'])
                    ->default('Kosong')
                    ->required(),
                TextInput::make('petugas_id')
                    ->numeric(),
                Textarea::make('kendala')
                    ->columnSpanFull(),
            ]);
    }
}
