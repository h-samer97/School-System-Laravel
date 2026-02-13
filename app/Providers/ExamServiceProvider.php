<?php

namespace App\Providers;

use App\Repository\ExamRepository;
use App\Repository\IExam;
use Illuminate\Support\ServiceProvider;

class ExamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IExam::class,
            ExamRepository::class
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
