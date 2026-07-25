<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected function getStats(): array
    {
        return [
            Stat::make('TOTAL USERS', '14,285')
                ->description('+12%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->icon('heroicon-o-users'),
            Stat::make('TRANSACTIONS', '48,902')
                ->description('+8.4%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([3, 12, 4, 10, 2, 15, 17])
                ->icon('heroicon-o-document-text'),
            Stat::make('TOTAL REVENUE', '$1.24M')
                ->description('-2.1%')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([17, 16, 14, 15, 14, 13, 12])
                ->icon('heroicon-o-currency-dollar'),
            Stat::make('ORDERS', '1,894')
                ->description('+24%')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->icon('heroicon-o-shopping-cart'),
        ];
    }
}
