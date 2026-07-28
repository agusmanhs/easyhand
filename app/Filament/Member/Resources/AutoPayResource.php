<?php

namespace App\Filament\Member\Resources;

use App\Filament\Member\Resources\AutoPayResource\Pages;
use App\Filament\Member\Resources\AutoPayResource\RelationManagers;
use App\Models\AutoPay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Product;

class AutoPayResource extends Resource
{
    protected static ?string $model = AutoPay::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $navigationLabel = 'Langganan (Auto Pay)';
    protected static ?string $modelLabel = 'Langganan';
    protected static ?string $pluralModelLabel = 'Langganan';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Pilih Produk')
                    ->options(Product::where('seller_product_status', true)->pluck('product_name', 'id'))
                    ->searchable()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('customer_no')
                    ->label('Nomor Tujuan / ID Pelanggan')
                    ->required(),
                Forms\Components\TextInput::make('zone_id')
                    ->label('Zone ID (Khusus Game)')
                    ->nullable(),
                    
                Forms\Components\Select::make('schedule_type')
                    ->label('Tipe Siklus')
                    ->options([
                        'daily' => 'Setiap Hari',
                        'weekly' => 'Setiap Minggu',
                        'monthly' => 'Setiap Bulan',
                    ])
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('schedule_day')
                    ->label('Hari / Tanggal')
                    ->helperText(fn (Forms\Get $get) => 
                        $get('schedule_type') === 'weekly' ? 'Isi 1 (Senin) s/d 7 (Minggu)' : 
                        ($get('schedule_type') === 'monthly' ? 'Isi 1 s/d 31' : 'Abaikan untuk siklus Harian')
                    )
                    ->numeric()
                    ->required(fn (Forms\Get $get) => in_array($get('schedule_type'), ['weekly', 'monthly']))
                    ->disabled(fn (Forms\Get $get) => $get('schedule_type') === 'daily'),
                Forms\Components\TimePicker::make('schedule_time')
                    ->label('Jam Eksekusi')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label('Status Aktif')
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.product_name')
                    ->label('Produk')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('customer_no')
                    ->label('Tujuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule_type')
                    ->label('Siklus')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'daily' => 'Harian',
                        'weekly' => 'Mingguan',
                        'monthly' => 'Bulanan',
                        default => $state,
                    })
                    ->color(fn ($state) => match($state) {
                        'daily' => 'info',
                        'weekly' => 'warning',
                        'monthly' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('next_run_at')
                    ->label('Jadwal Berikutnya')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAutoPays::route('/'),
            'create' => Pages\CreateAutoPay::route('/create'),
            'edit' => Pages\EditAutoPay::route('/{record}/edit'),
        ];
    }
}
