<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Http\Middleware\Authenticate;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->login()

            ->id('admin')
            ->path('admin')

            ->colors(['primary' => Color::Amber])
            ->pages([Pages\Dashboard::class])

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')

            ->maxContentWidth(config('panels_config.maxContentWidth'))
            ->middleware(config('panels_config.middlewares'))

            ->widgets([Widgets\AccountWidget::class, Widgets\FilamentInfoWidget::class])
            ->authMiddleware([Authenticate::class]);
    }
}
