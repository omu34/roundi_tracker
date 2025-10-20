<?php

namespace App\Filament\Resources\LinkClicks;
use App\Filament\Resources\LinkClicks\Schemas\LinkClickForm;
use App\Filament\Resources\LinkClicks\Tables\LinkClicksTable;
use App\Models\LinkClick;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class LinkClickResource extends Resource
{
    protected static ?string $model = LinkClick::class;

    protected static string | \UnitEnum | null $navigationGroup = 'User Analytics';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-link';

    public static function form(Schema $schema): Schema
    {

        return LinkClickForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LinkClicksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinkClicks::route('/'),
            'Edit' => Pages\EditLinkClick::route('/{record}'),
            'Create' => Pages\CreateLinkClick::route('/{record}'),
        ];
    }
}
