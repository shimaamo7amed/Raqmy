<?php

namespace App\Filament\Resources\InstructorsResource\Pages;

use App\Filament\Resources\InstructorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInstructors extends ViewRecord
{
    protected static string $resource = InstructorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
