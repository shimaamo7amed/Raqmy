<?php

namespace App\Filament\Resources\ContactUSResource\Pages;

use App\Filament\Resources\ContactUSResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUS extends EditRecord
{
    protected static string $resource = ContactUSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
