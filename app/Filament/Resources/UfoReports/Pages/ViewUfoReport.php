<?php

namespace App\Filament\Resources\UfoReports\Pages;

use App\Filament\Resources\UfoReports\UfoReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUfoReport extends ViewRecord
{
    protected static string $resource = UfoReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
