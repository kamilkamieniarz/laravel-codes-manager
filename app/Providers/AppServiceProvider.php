<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\CodeController;
use App\Services\CodeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CodeController::class, function ($app) {
            $controller = new CodeController();
            $controller->setCodeService($app->make(CodeService::class));
            
            return $controller;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force the use of Bootstrap 5 for pagination links
        Paginator::useBootstrapFive();
    }
}
