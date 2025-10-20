<?php

namespace App\Filament\Resources\LinkClicks\Widgets;

use App\Models\LinkClick;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class LinkClicksChart extends ChartWidget
{
    protected ?string $heading = 'Internal vs External Clicks (Last 7 Days)';
    protected ?string $icon = 'heroicon-o-chart-bar';

    protected function getData(): array
    {
        $dates = collect(range(6, 0))->map(fn($i) => Carbon::today()->subDays($i)->toDateString());
        $domain = parse_url(config('app.url'), PHP_URL_HOST);

        // Count internal vs external clicks
        $internalClicks = $dates->map(function ($date) use ($domain) {
            return LinkClick::whereDate('created_at', $date)
                ->where('url', 'like', "%{$domain}%")
                ->count();
        });

        $externalClicks = $dates->map(function ($date) use ($domain) {
            return LinkClick::whereDate('created_at', $date)
                ->where(function ($q) use ($domain) {
                    $q->where('url', 'not like', "%{$domain}%")
                      ->orWhereNull('url');
                })
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Internal Clicks',
                    'data' => $internalClicks->values(),
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
                [
                    'label' => 'External Clicks',
                    'data' => $externalClicks->values(),
                    'borderColor' => '#F97316',
                    'backgroundColor' => 'rgba(249, 115, 22, 0.2)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
            ],
            'labels' => $dates->map(fn($d) => Carbon::parse($d)->format('M d'))->values(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
