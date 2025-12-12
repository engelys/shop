<?php

use Filament\Http\Middleware;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

return [
    'maxContentWidth' => MaxWidth::Full,
    'middlewares' => [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        Middleware\AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
        Middleware\DisableBladeIconComponents::class,
        Middleware\DispatchServingFilamentEvent::class,
    ],
];