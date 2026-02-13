<?php

namespace App\Providers;

use App\Repository\FeesRepository;
use App\Repository\IFees;
use Illuminate\Support\ServiceProvider;

class FeesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
                IFees::class,
                FeesRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
