<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', \App\Http\Middleware\AdminAuth::class);
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
