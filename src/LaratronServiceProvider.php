<?php

declare(strict_types=1);

namespace Sandulat\Laratron;

use Illuminate\Support\ServiceProvider;
use Sandulat\Laratron\Http\Middleware\LaratronMiddleware;

final class LaratronServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laratron.php'),
            ], 'laratron-config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laratron');

        $this->app['router']->aliasMiddleware('laratron', LaratronMiddleware::class);

        $this->app->singleton('laratron', function () {
            return new Laratron;
        });
    }
}
