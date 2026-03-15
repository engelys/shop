<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IntegrationsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped(\App\Http\Integrations\WP\WPConnector::class, fn($app) => new \App\Http\Integrations\WP\WPConnector(
            endpoint: config('integrations.wp.endpoint'),
            consumer_key: config('integrations.wp.consumer_key'),
            consumer_secret: config('integrations.wp.consumer_secret'),
        ));
    }

    public function boot(): void
    {
        //
    }
}
