<?php

declare(strict_types=1);

namespace ThinkToShare\Payment;

use Illuminate\Support\ServiceProvider;

class BetterstackServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/betterstack.php' => config_path('betterstack.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/betterstack.php', 'betterstack'
        );
    }
}
