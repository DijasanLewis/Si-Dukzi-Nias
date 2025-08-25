<?php

namespace App\Filament\Resources\ZIChecklists\Pages;

use App\Filament\Resources\ZIChecklists\ZIChecklistResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZIChecklist extends EditRecord
{
    protected static string $resource = ZIChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
