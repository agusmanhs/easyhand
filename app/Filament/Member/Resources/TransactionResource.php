<?php

namespace App\Filament\Member\Resources;

use App\Filament\Member\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationLabel = 'Riwayat Transaksi';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id())->latest();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ref_id')->label('Ref ID')->searchable(),
                Tables\Columns\TextColumn::make('customer_no')->label('No. Tujuan')->searchable(),
                Tables\Columns\TextColumn::make('buyer_sku_code')->label('Kode Produk')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Harga')->money('idr', true),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Sukses' => 'success',
                        'Gagal' => 'danger',
                        'Pending' => 'warning',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('sn')->label('SN / Token'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('check_status')
                    ->label('Cek Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->visible(fn (Transaction $record) => $record->status === 'Pending')
                    ->action(function (Transaction $record) {
                        $username = \App\Models\Setting::where('key', 'digiflazz_username')->value('value');
                        $apiKey = \App\Models\Setting::where('key', 'digiflazz_production_key')->value('value');
                        $signature = md5($username . $apiKey . $record->ref_id);

                        $response = Http::post('https://api.digiflazz.com/v1/transaction', [
                            'username' => $username,
                            'buyer_sku_code' => $record->buyer_sku_code,
                            'customer_no' => $record->customer_no,
                            'ref_id' => $record->ref_id,
                            'sign' => $signature,
                        ]);

                        $result = $response->json();

                        if (isset($result['data'])) {
                            $status = $result['data']['status'];
                            $message = $result['data']['message'];
                            
                            $record->update([
                                'status' => $status,
                                'message' => $message,
                                'sn' => $result['data']['sn'] ?? $record->sn,
                            ]);

                            if ($status === 'Gagal') {
                                // Refund
                                $user = $record->user;
                                $user->saldo += $record->amount;
                                $user->save();
                                Notification::make()->title('Transaksi Gagal, saldo dikembalikan.')->warning()->send();
                            } elseif ($status === 'Sukses') {
                                Notification::make()->title('Transaksi telah Sukses!')->success()->send();
                            } else {
                                Notification::make()->title('Transaksi masih Pending')->info()->send();
                            }
                        } else {
                            Notification::make()->title('Gagal mengecek status')->danger()->send();
                        }
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
        ];
    }
}
