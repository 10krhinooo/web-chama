<?php

namespace App\Filament\Resources\ContributionsResource\Pages;

use App\Filament\Resources\ContributionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContributions extends EditRecord
{
    protected static string $resource = ContributionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
