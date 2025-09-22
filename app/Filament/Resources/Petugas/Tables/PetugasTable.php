<?php

namespace App\Filament\Resources\Petugas\Tables;

use App\Filament\Resources\Petugas\Pages\CreatePetugas;
use App\Filament\Resources\Petugas\Pages\EditPetugas;
use App\Filament\Resources\Petugas\Pages\ListPetugas;
use App\Filament\Resources\Petugas\Schemas\PetugasForm;
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

class PetugasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan kolom 'nama' sebagai teks, dan buat bisa di-sort
                TextColumn::make('nama')->sortable()->searchable(),
            ])
            ->filters([
                // (Filter bisa kita tambahkan nanti)
            ])
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make(), // Tambahkan aksi hapus
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
