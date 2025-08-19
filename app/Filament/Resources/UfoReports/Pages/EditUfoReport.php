<?php

namespace App\Filament\Resources\UfoReports\Pages;

use App\Filament\Resources\UfoReports\UfoReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUfoReport extends EditRecord
{
    protected static string $resource = UfoReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
