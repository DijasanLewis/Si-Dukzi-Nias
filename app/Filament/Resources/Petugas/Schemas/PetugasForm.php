<?php

namespace App\Filament\Resources\Petugas\Schemas;

use App\Filament\Resources\Petugas\Pages\CreatePetugas;
use App\Filament\Resources\Petugas\Pages\EditPetugas;
use App\Filament\Resources\Petugas\Pages\ListPetugas;
use App\Filament\Resources\Petugas\Tables\PetugasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Petugas;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;

class PetugasForm
{
    public static function configure(Schema $schema): Schema
    {       
        return $schema
        ->schema([
            // // Buat input teks untuk 'nama'
            // TextInput::make('nama')
            //     ->required() // Wajib diisi
            //     ->maxLength(255), // Panjang maksimal karakter
            Select::make('nama')
                ->createOptionAction(
                    fn (Action $action) => $action->modalWidth('3xl'),
                )       
        ]);
    }
}
