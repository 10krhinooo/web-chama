<?php

namespace App\Filament\Treasurer\Widgets;

use App\Models\Contributions;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class moneyChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
         $data = Trend::model(Contributions::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();

    return [
        'datasets' => [
            [
                'label' => 'Contributions',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
            ],
        ],
        'labels' => $data->map(fn (TrendValue $value) => $value->date),];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
