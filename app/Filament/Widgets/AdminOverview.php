<?php

namespace App\Filament\Widgets;

use App\Models\Chama;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
            ->description('All users in the system')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        Stat::make('Chama', Chama::query()->count())
           ->description('All Chamas in the system')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
        // Stat::make('Average time on page', '3:12')
        //     ->description('3% increase')
        //     ->descriptionIcon('heroicon-m-arrow-trending-up')
        //     ->color('success'),
        ];
    }
}
