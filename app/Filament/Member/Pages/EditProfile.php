<?php

namespace App\Filament\Member\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Forms\Components\Section;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                Section::make('Pengaturan Toko / Struk')
                    ->description('Atur nama toko dan keuntungan tambahan untuk struk yang dicetak.')
                    ->schema([
                        TextInput::make('store_name')
                            ->label('Nama Toko')
                            ->placeholder('Contoh: EasyHand Cell')
                            ->maxLength(255),
                        TextInput::make('store_markup')
                            ->label('Markup Struk (Rp)')
                            ->numeric()
                            ->default(0)
                            ->helperText('Nominal ini akan ditambahkan ke harga struk (tidak memotong saldo Anda, hanya untuk cetak struk pelanggan).')
                            ->minValue(0),
                    ]),
            ]);
    }
}
