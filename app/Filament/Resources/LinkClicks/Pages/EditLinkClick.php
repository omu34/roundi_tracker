<?php

namespace App\Filament\Resources\LinkClicks\Pages;

use App\Filament\Resources\LinkClicks\LinkClickResource;
use App\Filament\Resources\LinkClicks\Widgets\LinkClicksChart;
use App\Filament\Resources\LinkClicks\Widgets\LinkClickStats;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLinkClick extends EditRecord
{
    protected static string $resource = LinkClickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function getWidgets(): array
    {
        return [
            LinkClicksChart::class,
            LinkClickStats::class
        ];
    }
}
