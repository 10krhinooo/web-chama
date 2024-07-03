<?php

namespace App\Filament\Resources\ChamaResource\Pages;

use App\Filament\Resources\ChamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChamas extends ListRecords
{
    protected static string $resource = ChamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
