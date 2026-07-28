<?php

namespace App\Filament\Member\Resources\AutoPayResource\Pages;

use App\Filament\Member\Resources\AutoPayResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAutoPay extends CreateRecord
{
    protected static string $resource = AutoPayResource::class;
}
