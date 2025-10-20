<?php

namespace App\Filament\Resources\LinkClicks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LinkClickForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('url')->required()->url()->columnSpanFull(),
                TextInput::make('page_title'),
            ]);
    }
}
