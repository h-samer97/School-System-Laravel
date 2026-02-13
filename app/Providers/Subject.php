<?php

namespace App\Providers;

use App\Repository\ISubjects;
use App\Repository\SubjectsRepository;
use Illuminate\Support\ServiceProvider;

class Subject extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ISubjects::class,
            SubjectsRepository::class
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
