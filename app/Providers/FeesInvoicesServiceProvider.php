<?php

namespace App\Providers;

use App\Repository\FeesInvoicesRepository;
use App\Repository\IFeesInvoices;
use Illuminate\Support\ServiceProvider;

class FeesInvoicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IFeesInvoices::class,
            FeesInvoicesRepository::class
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
