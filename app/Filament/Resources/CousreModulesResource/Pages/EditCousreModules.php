<?php

namespace App\Filament\Resources\CousreModulesResource\Pages;

use App\Filament\Resources\CousreModulesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCousreModules extends EditRecord
{
    protected static string $resource = CousreModulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
