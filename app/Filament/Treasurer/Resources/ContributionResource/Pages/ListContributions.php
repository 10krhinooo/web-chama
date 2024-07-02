<?php

namespace App\Filament\Treasurer\Resources\ContributionResource\Pages;

use App\Filament\Treasurer\Resources\ContributionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContributions extends ListRecords
{
    protected static string $resource = ContributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
