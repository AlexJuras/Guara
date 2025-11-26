<?php

namespace App\Providers;

use App\Models\Conta;
use App\Observers\ContaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    // Sua observação existente
    Conta::observe(ContaObserver::class);

        if ($this->app->environment('local')) {
        \URL::forceScheme('https');
    }


}
}
