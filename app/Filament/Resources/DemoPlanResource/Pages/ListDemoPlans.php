<?php

namespace App\Filament\Resources\DemoPlanResource\Pages;

use App\Filament\Resources\DemoPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDemoPlans extends ListRecords
{
    protected static string $resource = DemoPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
