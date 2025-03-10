<?php

namespace App\Filament\Resources\InstructorsFormResource\Pages;

use App\Filament\Resources\InstructorsFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInstructorsForm extends ViewRecord
{
    protected static string $resource = InstructorsFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
