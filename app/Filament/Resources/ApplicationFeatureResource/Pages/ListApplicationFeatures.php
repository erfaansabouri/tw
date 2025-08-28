<?php

namespace App\Filament\Resources\ApplicationFeatureResource\Pages;

use App\Filament\Resources\ApplicationFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicationFeatures extends ListRecords
{
    protected static string $resource = ApplicationFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
