<?php

namespace App\Filament\Member\Resources;

use App\Filament\Member\Resources\DepositResource\Pages;
use App\Filament\Member\Resources\DepositResource\RelationManagers;
use App\Models\Deposit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class DepositResource extends Resource
{
    protected static ?string $model = Deposit::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Topup Saldo';
    protected static ?string $modelLabel = 'Deposit';
    protected static ?string $pluralModelLabel = 'Deposit';
    protected static ?string $navigationGroup = 'Finance';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('payment_method_id')
                    ->label('Metode Pembayaran')
                    ->relationship('paymentMethod', 'name', fn (Builder $query) => $query->where('is_active', true))
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->label('Nominal Topup')
                    ->required()
                    ->numeric()
                    ->minValue(10000)
                    ->prefix('Rp'),
                Forms\Components\FileUpload::make('proof')
                    ->label('Bukti Transfer (Opsional)')
                    ->image()
                    ->directory('deposits-proofs')
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Instruksi Pembayaran')
                    ->description('Silakan transfer TEPAT sesuai nominal hingga 3 digit terakhir agar sistem dapat memproses otomatis.')
                    ->schema([
                        Infolists\Components\TextEntry::make('paymentMethod.name')
                            ->label('Bank / E-Wallet'),
                        Infolists\Components\TextEntry::make('paymentMethod.account_number')
                            ->label('Nomor Rekening Tujuan')
                            ->copyable()
                            ->weight('bold')
                            ->color('primary'),
                        Infolists\Components\TextEntry::make('paymentMethod.account_name')
                            ->label('Atas Nama'),
                        Infolists\Components\TextEntry::make('total_transfer')
                            ->label('Nominal Harus Ditransfer')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                            ->copyable()
                            ->weight('bold')
                            ->color('danger')
                            ->size(Infolists\Components\TextEntry\TextEntrySize::Large),
                        Infolists\Components\TextEntry::make('paymentMethod.instructions')
                            ->label('Petunjuk Khusus')
                            ->markdown()
                            ->columnSpanFull(),
                    ])->columns(2),
                    
                Infolists\Components\Section::make('Status Deposit')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                            }),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Waktu Request')
                            ->dateTime(),
                    ])->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->copyable()
                    ->copyMessage('Nominal berhasil disalin')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Deposit $record) => $record->status === 'pending'),
            ])
            ->bulkActions([
                //
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
            'view' => Pages\ViewDeposit::route('/{record}'),
            'edit' => Pages\EditDeposit::route('/{record}/edit'),
        ];
    }
}
