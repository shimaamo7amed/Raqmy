<?php

namespace App\Filament\Resources\CousreModulesItemResource\Pages;

use App\Filament\Resources\CousreModulesItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCousreModulesItem extends EditRecord
{
    protected static string $resource = CousreModulesItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
