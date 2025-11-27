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
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            
            ->default()
            ->id('admin')
            ->path('')
            ->login()
            ->registration()
            ->brandName('Guará')
            ->brandLogo(asset('guara-logo.jpeg'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('favicon.ico'))
            ->colors([
                'primary' => Color::hex('#f97316'), // Laranja principal
                'secondary' => Color::hex('#1f2937'), // Cinza escuro
                'accent' => Color::hex('#ea580c'), // Laranja escuro
                'neutral' => Color::hex('#374151'), // Cinza médio
                'success' => Color::hex('#10b981'),
                'warning' => Color::hex('#f59e0b'),
                'danger' => Color::hex('#ef4444'),
                'info' => Color::hex('#3b82f6'),
            ])
            ->resources([
                \App\Filament\Resources\Contas\ContaResource::class,
                \App\Filament\Resources\Cadastros\CadastroResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\SaldoStatsWidget::class,
                \App\Filament\Widgets\ReceitasDespesasPendentesWidget::class,
                \App\Filament\Resources\Contas\Widgets\ContasReceitaDespesaChart::class,
                \App\Filament\Widgets\ContasPagasChart::class,
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
            ->domain(null);
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn (): string => Blade::render(<<<'HTML'
                <style>
                    /* Tornar a logo redonda com sombra sutil */
                    .fi-logo img,
                    .fi-sidebar-header img,
                    [class*="logo"] img {
                        border-radius: 50% !important;
                        object-fit: cover !important;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
                        background: white !important;
                        padding: 2px !important;
                    }
                    
                    /* Esconder menções ao Filament e Laravel no footer */
                    .fi-footer,
                    [class*="footer"] a[href*="filamentphp"],
                    [class*="footer"] a[href*="laravel"] {
                        display: none !important;
                    }
                </style>
            HTML)
        );
    }
}
