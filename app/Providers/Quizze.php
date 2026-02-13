<?php

namespace App\Providers;

use App\Repository\IQuizze;
use App\Repository\QuizzeRepository;
use Illuminate\Support\ServiceProvider;

class Quizze extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
                IQuizze::class,
                QuizzeRepository::class
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
