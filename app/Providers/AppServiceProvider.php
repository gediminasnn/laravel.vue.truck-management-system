<?php

namespace App\Providers;

use App\Interfaces\ITruckRepository;
use App\Interfaces\ITruckService;
use App\Repositories\TruckRepository;
use App\Services\TruckService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ITruckRepository::class, TruckRepository::class);
        $this->app->bind(ITruckService::class, TruckService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
