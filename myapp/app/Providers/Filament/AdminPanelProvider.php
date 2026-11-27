<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession as SessionAuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
// use Filament\Widgets\AccountWidget;
// use Filament\Widgets\FilamentInfoWidget;
// use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            //BRANDING
            ->brandName('inventory management system')
            ->brandLogo('/images/logo.png')
            ->brandLogoHeight('3rem')
            ->favicon('/images/favicon.png')
            //COLORS
            ->colors([
                'primary' => Color::Emerald,
                
            ])
            ->darkMode(false)
            //SIDEBAR
            ->sidebarCollapsibleOnDesktop()
            //NAVIGATION GROUPS
            ->navigationGroups([
                NavigationGroup::make()->label('Master Data'),
                NavigationGroup::make()->label('Inventory'),
                NavigationGroup::make()->label('Transactions'),
                NavigationGroup::make()->label('Adjustments'),
                NavigationGroup::make()->label('Reports'),
            ])
            //LOGIN
            ->login()
            // RESOURCES, PAGES, WIDGETS
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            //MIDDLEWARE
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                SessionAuthenticateSession::class,
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
