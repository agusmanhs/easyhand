<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MemberPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('member')
            ->path('member')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->brandName('EasyHand')
            ->colors([
                'primary' => '#b1773a',
            ])
            ->brandLogo(fn () => view('filament.logo'))
            ->favicon(asset('images/easyhand-logo.svg'))
            ->discoverResources(in: app_path('Filament/Member/Resources'), for: 'App\\Filament\\Member\\Resources')
            ->discoverPages(in: app_path('Filament/Member/Pages'), for: 'App\\Filament\\Member\\Pages')
            ->pages([
                \App\Filament\Member\Pages\MemberDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Member/Widgets'), for: 'App\\Filament\\Member\\Widgets')
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
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => \Illuminate\Support\Facades\View::make('filament.member.components.mobile-css')->render()
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::BODY_END,
                fn (): string => \Illuminate\Support\Facades\View::make('filament.member.components.bottom-nav')->render()
            );
    }
}
