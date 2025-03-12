<?php

namespace App\Filament\Resources\CousreModulesItemResource\Pages;

use App\Filament\Resources\CousreModulesItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCousreModulesItem extends ViewRecord
{
    protected static string $resource = CousreModulesItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
