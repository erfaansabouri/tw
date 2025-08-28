<?php

namespace App\Filament\Resources\ApplicationFeatureResource\Pages;

use App\Filament\Resources\ApplicationFeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicationFeature extends EditRecord
{
    protected static string $resource = ApplicationFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
