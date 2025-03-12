<?php

namespace App\Filament\Resources\CousreVideosResource\Pages;

use App\Filament\Resources\CousreVideosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCousreVideos extends EditRecord
{
    protected static string $resource = CousreVideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
