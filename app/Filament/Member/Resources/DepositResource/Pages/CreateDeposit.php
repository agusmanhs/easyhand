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
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }

    protected function afterCreate(): void
    {
        try {
            $deposit = $this->record;
            $user = auth()->user();
            
            $msg = "<b>💰 Request Deposit Baru!</b>\n\n"
                 . "<b>Member:</b> {$user->name} ({$user->email})\n"
                 . "<b>Metode:</b> {$deposit->paymentMethod->name}\n"
                 . "<b>Nominal:</b> Rp " . number_format($deposit->amount, 0, ',', '.') . "\n"
                 . "<b>Kode Unik:</b> {$deposit->unique_code}\n"
                 . "<b>Total Transfer:</b> Rp " . number_format($deposit->total_transfer, 0, ',', '.') . "\n"
                 . "<b>Status:</b> PENDING";
                 
            \App\Services\TelegramService::sendToGroup($msg);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal kirim notif telegram deposit: ' . $e->getMessage());
        }
    }
}
