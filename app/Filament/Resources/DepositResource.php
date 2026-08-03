<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepositResource\Pages;
use App\Filament\Resources\DepositResource\RelationManagers;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Deposits (Admin)';
    protected static ?string $modelLabel = 'Deposit';
    protected static ?string $navigationGroup = 'Finance';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('payment_method_id')
                    ->relationship('paymentMethod', 'name')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('unique_code')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_transfer')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required()
                    ->default('pending'),
                Forms\Components\FileUpload::make('proof')
                    ->image()
                    ->directory('deposits-proofs')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Member')
                    ->searchable(),
                Tables\Columns\TextColumn::make('paymentMethod.name')
                    ->label('Metode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Nominal')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('unique_code')
                    ->label('Kode Unik')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_transfer')
                    ->label('Total Transfer')
                    ->weight('bold')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->visible(fn (Deposit $record) => $record->status === 'pending')
                    ->action(function (Deposit $record) {
                        $record->update(['status' => 'approved']);
                        $user = $record->user;
                        $user->saldo = $user->saldo + $record->total_transfer;
                        $user->save();
                        \Filament\Notifications\Notification::make()->title('Deposit Berhasil Disetujui')->success()->send();
                        
                        try {
                            $msg = "<b>✅ Deposit Disetujui!</b>\n\n"
                                 . "<b>Member:</b> {$user->name}\n"
                                 . "<b>Metode:</b> {$record->paymentMethod->name}\n"
                                 . "<b>Nominal:</b> Rp " . number_format($record->total_transfer, 0, ',', '.') . "\n"
                                 . "<b>Status:</b> BERHASIL MASUK KE SALDO";
                            \App\Services\TelegramService::sendToGroup($msg);
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim notif telegram deposit acc: ' . $e->getMessage());
                        }
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->visible(fn (Deposit $record) => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('notes')->label('Alasan Penolakan')->required(),
                    ])
                    ->action(function (array $data, Deposit $record) {
                        $record->update(['status' => 'rejected', 'notes' => $data['notes']]);
                        \Filament\Notifications\Notification::make()->title('Deposit Ditolak')->success()->send();
                        
                        try {
                            $user = $record->user;
                            $msg = "<b>❌ Deposit Ditolak!</b>\n\n"
                                 . "<b>Member:</b> {$user->name}\n"
                                 . "<b>Metode:</b> {$record->paymentMethod->name}\n"
                                 . "<b>Nominal:</b> Rp " . number_format($record->total_transfer, 0, ',', '.') . "\n"
                                 . "<b>Alasan:</b> {$data['notes']}";
                            \App\Services\TelegramService::sendToGroup($msg);
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error('Gagal kirim notif telegram deposit tolak: ' . $e->getMessage());
                        }
                    }),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeposits::route('/'),
            'create' => Pages\CreateDeposit::route('/create'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
