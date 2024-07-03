<?php

namespace App\Filament\Resources\ChamaResource\Pages;

use App\Filament\Resources\ChamaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditChama extends EditRecord
{
    protected static string $resource = ChamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
          return Notification::make()
        ->success()
        ->title('Chama Edited')
        ->body('The chama was updated successfully');
    }
}
