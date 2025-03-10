<?php

namespace App\Filament\Resources\InstructorsFormResource\Pages;

use App\Filament\Resources\InstructorsFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstructorsForms extends ListRecords
{
    protected static string $resource = InstructorsFormResource::class;

    protected function getHeaderActions(): array
    {
        // return [
        //     Actions\CreateAction::make(),
        // ];
        return [
            // Disable the "Create" button
        ];
    }

    protected function getTableActions(): array
    {
        return [
            // Disable the "Edit" button
        ];
    }
    
}
