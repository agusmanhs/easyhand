<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class RecentTransactions extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Transactions';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()->latest()->limit(10)
            )
            ->columns([
                TextColumn::make('ref_id')
                    ->label('TRANSACTION ID')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->formatStateUsing(fn ($state) => '#' . $state),
                TextColumn::make('user.name')
                    ->label('CUSTOMER')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Transaction $record): string => substr($record->user->name, 0, 2)),
                TextColumn::make('buyer_sku_code')
                    ->label('PRODUCT')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('AMOUNT')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('status')
                    ->label('STATUS')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Sukses' => 'success',
                        'Gagal' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('DATE')
                    ->dateTime('d M, Y H:i')
                    ->sortable(),
            ]);
    }
}
