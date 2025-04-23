<?php

namespace App\Filament\Resources\ContactUSResource\Pages;

use App\Filament\Resources\ContactUSResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactUS extends ViewRecord
{
    protected static string $resource = ContactUSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
