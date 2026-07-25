<?php

namespace App\Filament\Member\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class MemberDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Overview';
    protected static ?string $title = 'Welcome back, Alex!';
    protected static string $view = 'filament.member.pages.dashboard';
    
    public function getSubheading(): ?string
    {
        return 'Manage your finances with speed and precision.';
    }
}
