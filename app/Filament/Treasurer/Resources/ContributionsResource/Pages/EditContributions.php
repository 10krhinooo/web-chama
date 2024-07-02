<?php

namespace App\Filament\Treasurer\Resources\ContributionsResource\Pages;

use App\Filament\Treasurer\Resources\ContributionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContributions extends EditRecord
{
    protected static string $resource = ContributionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
