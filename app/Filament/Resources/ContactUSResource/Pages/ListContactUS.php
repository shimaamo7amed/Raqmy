<?php

namespace App\Filament\Resources\ContactUSResource\Pages;

use App\Filament\Resources\ContactUSResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUS extends ListRecords
{
    protected static string $resource = ContactUSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
