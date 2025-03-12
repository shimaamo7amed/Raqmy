<?php

namespace App\Filament\Resources\CousreModulesResource\Pages;

use App\Filament\Resources\CousreModulesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCousreModules extends ViewRecord
{
    protected static string $resource = CousreModulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
