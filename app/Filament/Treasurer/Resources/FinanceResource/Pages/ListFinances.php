<?php

namespace App\Filament\Treasurer\Resources\FinanceResource\Pages;

use App\Filament\Treasurer\Resources\FinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinances extends ListRecords
{
    protected static string $resource = FinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
