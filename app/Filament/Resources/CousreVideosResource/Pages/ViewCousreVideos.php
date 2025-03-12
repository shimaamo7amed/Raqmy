<?php

namespace App\Filament\Resources\CousreVideosResource\Pages;

use App\Filament\Resources\CousreVideosResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCousreVideos extends ViewRecord
{
    protected static string $resource = CousreVideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
