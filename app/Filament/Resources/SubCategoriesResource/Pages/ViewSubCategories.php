<?php

namespace App\Filament\Resources\SubCategoriesResource\Pages;

use App\Filament\Resources\SubCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubCategories extends ViewRecord
{
    protected static string $resource = SubCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
