<?php

namespace App\Filament\Resources\UfoReports;

use App\Filament\Resources\UfoReports\Pages\CreateUfoReport;
use App\Filament\Resources\UfoReports\Pages\EditUfoReport;
use App\Filament\Resources\UfoReports\Pages\ListUfoReports;
use App\Filament\Resources\UfoReports\Pages\ViewUfoReport;
use App\Filament\Resources\UfoReports\Schemas\UfoReportForm;
use App\Filament\Resources\UfoReports\Schemas\UfoReportInfolist;
use App\Filament\Resources\UfoReports\Tables\UfoReportsTable;
use App\Models\UfoReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UfoReportResource extends Resource
{
    protected static ?string $model = UfoReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return UfoReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UfoReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UfoReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUfoReports::route('/'),
            'create' => CreateUfoReport::route('/create'),
            'view' => ViewUfoReport::route('/{record}'),
            'edit' => EditUfoReport::route('/{record}/edit'),
        ];
    }
}
