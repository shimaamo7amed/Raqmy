<?php

namespace App\Filament\Resources\InstructorsFormResource\Pages;

use App\Filament\Resources\InstructorsFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstructorsForm extends EditRecord
{
    protected static string $resource = InstructorsFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
