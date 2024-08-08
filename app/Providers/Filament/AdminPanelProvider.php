<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\ACountsWidget;
use App\Filament\Widgets\CountWidget;
use App\Filament\Widgets\CircuitStatusPieChart;
use App\Filament\Widgets\CiruitTypesChart;
use App\Filament\Widgets\CompletedEventsLineChart;
use App\Filament\Widgets\EventLineChart;
use App\Filament\Widgets\InitiatedEventsLineChart;
use App\Filament\Widgets\TheCircuitStatusPieChart;
use App\Filament\Widgets\TheCircuitTypesPieChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Madinah Health Cluster')
            ->brandLogo(asset('images/logo.png'))
            ->colors([
                'primary' => Color::Blue,
            ])
            ->databaseNotifications()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
                ACountsWidget::class,
                CompletedEventsLineChart::class,
                InitiatedEventsLineChart::class,
                TheCircuitStatusPieChart::class,
                TheCircuitTypesPieChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
