<?php

namespace App\Filament\Resources\ZIChecklists;

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
use Filament\Tables\Table;

class ZIChecklistResource extends Resource
{
    protected static ?string $model = ZIChecklist::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('petugas_id')
                    ->relationship('petugas', 'nama')
                    ->label('Penanggung Jawab'),
                Forms\Components\Textarea::make('kendala')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pertanyaan')->searchable()->wrap(),
                Tables\Columns\TextColumn::make('petugas.nama')->label('Penanggung Jawab')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'Kosong' => 'danger',
                    'Terisi' => 'success',
                }),
                Tables\Columns\TextColumn::make('kendala')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('assignPetugas')
                        ->label('Tugaskan ke Petugas')
                        ->icon('heroicon-o-user-plus')
                        ->form([
                            Forms\Components\Select::make('petugas_id')
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
