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
        // Professional way to handle Setter Injection via Container Hooks
        $this->app->afterResolving(CodeController::class, function (CodeController $controller, $app) {
            $controller->setCodeService($app->make(CodeService::class));
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
