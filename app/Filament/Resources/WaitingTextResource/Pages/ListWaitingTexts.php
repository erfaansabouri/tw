<?php

namespace App\Filament\Resources\WaitingTextResource\Pages;

use App\Filament\Resources\WaitingTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaitingTexts extends ListRecords
{
    protected static string $resource = WaitingTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
