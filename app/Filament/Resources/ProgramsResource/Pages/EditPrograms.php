<?php

namespace App\Filament\Resources\ProgramsResource\Pages;

use App\Filament\Resources\ProgramsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrograms extends EditRecord
{
    protected static string $resource = ProgramsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
