<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Member;
use App\Models\Visitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Members',Member::count())
            ->description(Member::where('created_at', '>=', now()->subDays(7))->count() . ' new this week')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            
            Stat::make('Books', Book::count())
            ->description(Book::where('created_at', '>=', now()->subDays(7))->count() . ' new this week')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),

            Stat::make('Visitor',Visitor::count())
            ->description(Visitor::where('created_at', '>=', now()->subDays(7))->count() . ' new this week')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
        ];
    }
}
