<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Analysis';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 2; // to take more space

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => [21200, 32400, 38900, 24000, 52400, 48000, 41000, 54000],
                    'backgroundColor' => '#b1773a',
                    'borderColor' => '#9E590A',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
