<?php

namespace App\Filament\Resources\UfoReports\Pages;

use App\Filament\Resources\UfoReports\UfoReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUfoReports extends ListRecords
{
    protected static string $resource = UfoReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
