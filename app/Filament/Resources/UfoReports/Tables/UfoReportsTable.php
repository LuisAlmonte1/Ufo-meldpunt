<?php

namespace App\Filament\Resources\UfoReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UfoReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('reporter_name')
                    ->searchable(),
                TextColumn::make('reporter_email')
                    ->searchable(),
                TextColumn::make('incident_datetime')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('category'),
                TextColumn::make('photo_path')
                    ->searchable(),
                TextColumn::make('status'),
                IconColumn::make('is_paid')
                    ->boolean(),
                TextColumn::make('support_fee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
