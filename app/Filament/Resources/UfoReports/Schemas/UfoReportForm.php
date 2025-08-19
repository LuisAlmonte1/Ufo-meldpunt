<?php

namespace App\Filament\Resources\UfoReports\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UfoReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(null),
                TextInput::make('reporter_name')
                    ->default(null),
                TextInput::make('reporter_email')
                    ->email()
                    ->default(null),
                DateTimePicker::make('incident_datetime')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category')
                    ->options([
            'licht' => 'Licht',
            'object' => 'Object',
            'ontmoeting' => 'Ontmoeting',
            'geluid' => 'Geluid',
            'anders' => 'Anders',
        ])
                    ->required(),
                TextInput::make('photo_path')
                    ->default(null),
                Select::make('status')
                    ->options([
            'nieuw' => 'Nieuw',
            'in_behandeling' => 'In behandeling',
            'opgelost' => 'Opgelost',
            'gesloten' => 'Gesloten',
        ])
                    ->default('nieuw')
                    ->required(),
                Toggle::make('is_paid')
                    ->required(),
                TextInput::make('support_fee')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
