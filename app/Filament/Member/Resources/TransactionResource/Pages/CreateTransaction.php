<?php

namespace App\Filament\Member\Resources\TransactionResource\Pages;

use App\Filament\Member\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
