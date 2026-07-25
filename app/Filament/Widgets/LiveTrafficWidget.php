<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class LiveTrafficWidget extends Widget
{
    protected static string $view = 'filament.widgets.live-traffic-widget';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
}
