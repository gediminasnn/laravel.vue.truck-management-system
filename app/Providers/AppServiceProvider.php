<?php

namespace App\Providers;

use App\Interfaces\ITruckRepository;
use App\Interfaces\ITruckService;
use App\Interfaces\ITruckSubunitRepository;
use App\Interfaces\ITruckSubunitService;
use App\Repositories\TruckRepository;
use App\Repositories\TruckSubunitRepository;
use App\Services\TruckService;
use App\Services\TruckSubunitService;
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
        $this->app->bind(ITruckSubunitService::class, TruckSubunitService::class);
        $this->app->bind(ITruckSubunitRepository::class, TruckSubunitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
