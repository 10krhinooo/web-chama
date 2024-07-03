<?php

namespace App\Filament\Resources\ContributionsResource\Pages;

use App\Filament\Resources\ContributionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContributions extends ListRecords
{
    protected static string $resource = ContributionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
