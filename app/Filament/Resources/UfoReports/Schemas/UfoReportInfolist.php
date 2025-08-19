<?php

namespace App\Filament\Resources\UfoReports\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UfoReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name'),
                TextEntry::make('reporter_name'),
                TextEntry::make('reporter_email'),
                TextEntry::make('incident_datetime')
                    ->dateTime(),
                TextEntry::make('location'),
                TextEntry::make('category'),
                TextEntry::make('photo_path'),
                TextEntry::make('status'),
                IconEntry::make('is_paid')
                    ->boolean(),
                TextEntry::make('support_fee')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
