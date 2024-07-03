<?php

namespace App\Filament\Resources\ChamaResource\Pages;

use App\Filament\Resources\ChamaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateChama extends CreateRecord
{
    protected static string $resource = ChamaResource::class;

    protected  function getCreatedNotification():?Notification
    {
        return Notification::make()
        ->success()
        ->title('Chama Created')
        ->body('The chama was created successfully');

    }
}
