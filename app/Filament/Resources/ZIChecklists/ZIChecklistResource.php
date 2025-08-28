<?php

namespace App\Filament\Resources\ZIChecklists;

use App\Models\Petugas;
use App\Filament\Resources\ZIChecklists\Pages\CreateZIChecklist;
use App\Filament\Resources\ZIChecklists\Pages\EditZIChecklist;
use App\Filament\Resources\ZIChecklists\Pages\ListZIChecklists;
use App\Filament\Resources\ZIChecklists\Schemas\ZIChecklistForm;
use App\Filament\Resources\ZIChecklists\Tables\ZIChecklistsTable;
use App\Models\ZIChecklist;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Forms;
use Illuminate\Support\Collection;

class ZIChecklistResource extends Resource
{
    protected static ?string $model = ZIChecklist::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->schema([
            // Kelompokkan field berdasarkan hirarki untuk kerapian
            TextInput::make('aspek')->label('Aspek (misal: A. Pengungkit)')->required(),
            TextInput::make('area')->label('Area (misal: I. Pemenuhan)')->required(),
            TextInput::make('pilar')->label('Pilar (misal: 1. Manajemen Perubahan)')->required(),
            TextInput::make('sub_pilar')->label('Sub Pilar (misal: i. Penyusunan Tim Kerja)')->required(),
            
            // Gunakan Textarea untuk deskripsi pertanyaan yang lebih panjang
            Textarea::make('pertanyaan')
                ->label('Pertanyaan')
                ->required()
                ->columnSpanFull(), // Agar field ini memanjang penuh

            // TextInput::make('google_drive_folder_id')->label('ID Folder Google Drive')->required(),

            // Select dropdown untuk memilih status
            Select::make('status')
                ->options([
                    'Kosong' => 'Kosong',
                    'Terisi' => 'Terisi',
                ])
                ->required(),

            // Select dropdown untuk menugaskan petugas (PCL)
            Select::make('petugas_id')
                ->label('Penanggung Jawab (PCL)')
                ->options(Petugas::all()->pluck('nama', 'id')) // Ambil data dari tabel petugas
                ->searchable(),

            Textarea::make('kendala')
                ->label('Catatan/Kendala')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tampilkan hanya deskripsi utama dan status agar tabel tidak terlalu lebar
                TextColumn::make('pertanyaan')->label('Pertanyaan')->searchable()->limit(50)->sortable(),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'Kosong' => 'danger',
                    'Terisi' => 'success',
                }),
                TextColumn::make('petugas.nama')->label('PCL')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('assignPetugas')
                        ->label('Tugaskan ke Petugas')
                        ->icon('heroicon-o-user-plus')
                        ->form([
                            Select::make('petugas_id')
                                ->label('Pilih Petugas')
                                ->options(Petugas::all()->pluck('nama', 'id'))
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each->update(['petugas_id' => $data['petugas_id']]);
                        }),
                ]),
            ]);
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
            'index' => ListZIChecklists::route('/'),
            'create' => CreateZIChecklist::route('/create'),
            'edit' => EditZIChecklist::route('/{record}/edit'),
        ];
    }
}
