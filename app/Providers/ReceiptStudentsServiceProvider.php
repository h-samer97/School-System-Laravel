<?php

namespace App\Providers;

use App\Repository\IReceiptStudents;
use App\Repository\ReceiptStudentsRepository;
use Illuminate\Support\ServiceProvider;

class ReceiptStudentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
                IReceiptStudents::class,
                ReceiptStudentsRepository::class
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
