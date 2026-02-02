<?php

namespace Turndale\Toast;

use Illuminate\Support\ServiceProvider;
use Turndale\Toast\Services\ToastService;

class ToastServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ToastService::class, function ($app) {
            return new ToastService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'toast');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/toast'),
        ], 'toast-views');
    }
}
