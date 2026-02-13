<?php

namespace App\Providers;

use App\Repository\IPayment;
use App\Repository\PaymentRepository;
use Illuminate\Support\ServiceProvider;

class Payment extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
                IPayment::class,
                PaymentRepository::class
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
