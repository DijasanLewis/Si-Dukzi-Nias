<?php

namespace App\Filament\Resources\Petugas;

use App\Filament\Resources\Petugas\Pages\CreatePetugas;
use App\Filament\Resources\Petugas\Pages\EditPetugas;
use App\Filament\Resources\Petugas\Pages\ListPetugas;
use App\Filament\Resources\Petugas\Schemas\PetugasForm;
use App\Filament\Resources\Petugas\Tables\PetugasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Petugas;
use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PetugasResource extends Resource
{
    protected static ?string $model = Petugas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PetugasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PetugasTable::configure($table);
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
            'index' => ListPetugas::route('/'),
            'create' => CreatePetugas::route('/create'),
            'edit' => EditPetugas::route('/{record}/edit'),
        ];
    }
}
