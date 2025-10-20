<?php

namespace App\Filament\Resources\LinkClicks\Pages;

use App\Filament\Resources\LinkClicks\LinkClickResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLinkClicks extends ListRecords
{
    protected static string $resource = LinkClickResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
