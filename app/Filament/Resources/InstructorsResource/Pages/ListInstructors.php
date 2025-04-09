<?php

namespace App\Filament\Resources\InstructorsResource\Pages;

use App\Filament\Resources\InstructorsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstructors extends ListRecords
{
    protected static string $resource = InstructorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
