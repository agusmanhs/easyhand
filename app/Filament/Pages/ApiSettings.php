<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use App\Models\Setting;
use Filament\Notifications\Notification;
use Filament\Actions\Action;

class ApiSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationGroup = 'Settings';
    
    protected static ?string $title = 'API Settings';

    protected static string $view = 'filament.pages.api-settings';
    
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'digiflazz_username' => Setting::getVal('digiflazz_username'),
            'digiflazz_production_key' => Setting::getVal('digiflazz_production_key'),
            'digiflazz_webhook_secret' => Setting::getVal('digiflazz_webhook_secret'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Digiflazz API Configuration')
                    ->description('Manage your Digiflazz API credentials for transactions.')
                    ->schema([
                        TextInput::make('digiflazz_username')
                            ->label('Username')
                            ->required(),
                        TextInput::make('digiflazz_production_key')
                            ->label('Production Key')
                            ->password()
                            ->revealable()
                            ->required(),
                        TextInput::make('digiflazz_webhook_secret')
                            ->label('Webhook Secret')
                            ->password()
                            ->revealable()
                            ->helperText('Kosongkan jika Anda menonaktifkan fitur secret di Webhook Digiflazz.'),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Setting::setVal('digiflazz_username', $data['digiflazz_username']);
        Setting::setVal('digiflazz_production_key', $data['digiflazz_production_key']);
        Setting::setVal('digiflazz_webhook_secret', $data['digiflazz_webhook_secret'] ?? '');

        Notification::make()
            ->title('Settings Saved')
            ->success()
            ->send();
    }
}
