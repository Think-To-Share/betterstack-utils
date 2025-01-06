<?php

declare(strict_types=1);

namespace ThinkToShare\Betterstack;

use Illuminate\Support\ServiceProvider;

class BetterstackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/betterstack.php' => config_path('betterstack.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/betterstack.php', 'betterstack'
        );
    }
}
