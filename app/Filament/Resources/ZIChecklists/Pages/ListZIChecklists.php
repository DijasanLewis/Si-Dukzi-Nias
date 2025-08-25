<?php

namespace App\Filament\Resources\ZIChecklists\Pages;

use App\Filament\Resources\ZIChecklists\ZIChecklistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZIChecklists extends ListRecords
{
    protected static string $resource = ZIChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
