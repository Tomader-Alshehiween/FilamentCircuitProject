<?php

namespace App\Filament\Widgets;

use App\Models\Circuit;
use App\Models\Event;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ACountsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Users', User::count())
                ->description('number of users')
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->chart([3,6,1,8,0,2])
                ->color('info'),
            Stat::make('Circuits', Circuit::count())
                ->description('number of circuits')
                ->descriptionIcon('heroicon-s-cpu-chip', IconPosition::Before)
                ->chart([3,6,1,8,0,2])
                ->color('warning'),
            Stat::make('Events', Event::count())
                ->description('number of events')
                ->descriptionIcon('heroicon-s-flag', IconPosition::Before)
                ->chart([3,6,1,8,0,2])
                ->color('danger'),
        ];
    }
}
