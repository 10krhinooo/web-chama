<?php

namespace App\Filament\Treasurer\Resources\ContributionsResource\Pages;

use App\Filament\Treasurer\Resources\ContributionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContributions extends ViewRecord
{
    protected static string $resource = ContributionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
