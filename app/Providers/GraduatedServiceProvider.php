<?php

namespace App\Providers;

use App\Repository\IStudent;
use App\Repository\StudentRepository;
use Illuminate\Support\ServiceProvider;

class GraduatedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
               \App\Repository\IStudentGraduated::class,
        \App\Repository\StudentGraduatedRepository::class
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
