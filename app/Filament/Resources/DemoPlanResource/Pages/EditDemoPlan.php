<?php

namespace App\Filament\Resources\DemoPlanResource\Pages;

use App\Filament\Resources\DemoPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemoPlan extends EditRecord
{
    protected static string $resource = DemoPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
