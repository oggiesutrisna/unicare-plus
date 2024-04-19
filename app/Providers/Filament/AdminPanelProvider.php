<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
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
            ->globalSearchKeyBindings(['ctrl+k'])
            ->sidebarFullyCollapsibleOnDesktop()
            ->navigationItems([
                NavigationItem::make('Unicare Clinic')
                    ->icon('heroicon-o-pencil-square')
                    ->url('https://unicare-clinic.com', true)
                    ->group('Links'),
                NavigationItem::make('Hydromedical Clinic')
                    ->icon('heroicon-o-pencil-square')
                    ->url('https://www.hydromedicalbali.com', true)
                    ->group('Links'),
                NavigationItem::make('Mandalika Clinic')
                    ->icon('heroicon-o-pencil-square')
                    ->url('https://mandalica-clinic.com', true)
                    ->group('Links'),
            ])
            ->navigationItems([
                NavigationItem::make('Established')
                    ->url('https://oggiesutrisna.vercel.app')
                    ->icon('heroicon-o-user')
                    ->label('Established By: Oggie Sutrisna'),
            ])
            ->path('admin')
            ->registration()
            ->brandName('Unicare Plus')
            ->spa()
            ->font('Poppins')
            ->login()
            ->colors([
                'primary' => Color::Fuchsia,
                'info' => Color::Orange,
                'secondary' => Color::Cyan,
                'success' => Color::Lime,
                'danger' => Color::Red,
                'warning' => Color::Orange,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
