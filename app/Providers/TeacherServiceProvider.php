<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TeacherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
{
    $this->app->bind(
        \App\Repository\ITeacher::class,
        \App\Repository\TeacherRepository::class
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
