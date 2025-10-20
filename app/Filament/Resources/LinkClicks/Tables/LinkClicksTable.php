<?php

namespace App\Filament\Resources\LinkClicks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LinkClicksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('page_title')
                    ->label('Domain/Title')
                    ->searchable(),
                TextColumn::make('url')
                    ->label('Full URL')
                    ->limit(60)
                    ->url(fn($record) => $record->url) // Make it clickable
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Clicked At')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('today')
                    ->query(fn(Builder $q) => $q->whereDate('created_at', today())),
                Filter::make('this_week')
                    ->query(fn(Builder $q) =>
                        $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                    ),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
