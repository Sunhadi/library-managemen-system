<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ChartOverview extends ChartWidget
{
    protected static ?string $heading = 'Transaction Overview';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';


    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {

        $data = Trend::model(Transaction::class)
        ->between(
            start: now()->subYear(),
            end: now(),
        )
        ->perMonth()
        ->count();


        return [
            'datasets' => [
                [
                    'label' => 'Transaction',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
{
    return [
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
}
}
