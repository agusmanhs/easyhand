<?php

namespace App\Filament\Member\Resources\AutoPayResource\Pages;

use App\Filament\Member\Resources\AutoPayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutoPay extends EditRecord
{
    protected static string $resource = AutoPayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
