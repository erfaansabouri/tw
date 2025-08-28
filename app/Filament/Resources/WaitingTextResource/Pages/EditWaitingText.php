<?php

namespace App\Filament\Resources\WaitingTextResource\Pages;

use App\Filament\Resources\WaitingTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaitingText extends EditRecord
{
    protected static string $resource = WaitingTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
