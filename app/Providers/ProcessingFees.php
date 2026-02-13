<?php

namespace App\Providers;

use App\Repository\IProcessingFees;
use App\Repository\ProcessingFeesRepository;
use Illuminate\Support\ServiceProvider;

class ProcessingFees extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IProcessingFees::class,
            ProcessingFeesRepository::class
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
