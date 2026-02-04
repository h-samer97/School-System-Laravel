<?php

namespace App\Providers;

use App\Repository\IStudent;
use App\Repository\StudentRepository;
use Illuminate\Support\ServiceProvider;

class StudentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(

            IStudent::class,
            StudentRepository::class

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
