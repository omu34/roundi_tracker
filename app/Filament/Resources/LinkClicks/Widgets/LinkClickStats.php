<?php

namespace App\Filament\Resources\LinkClicks\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\LinkClick;


class LinkClickStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Clicks', LinkClick::count())
                ->description('All clicks recorded'),
            Stat::make('Today\'s Clicks', LinkClick::whereDate('created_at', today())->count())
                ->description('Clicks from today'),
            Stat::make('Unique Users', LinkClick::distinct('user_id')->count('user_id'))
                ->description('Users who have clicked'),
        ];
    }
}



