<?php

namespace App\Filament\Member\Resources\DepositResource\Pages;

use App\Filament\Member\Resources\DepositResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeposit extends CreateRecord
{
    protected static string $resource = DepositResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['unique_code'] = rand(100, 999);
        $data['total_transfer'] = $data['amount'] + $data['unique_code'];
        $data['status'] = 'pending';
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
