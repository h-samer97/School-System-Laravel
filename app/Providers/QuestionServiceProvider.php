<?php

namespace App\Providers;

use App\Repository\IQuestions;
use App\Repository\QuestionsRepository;
use Illuminate\Support\ServiceProvider;

class QuestionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IQuestions::class,
            QuestionsRepository::class
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
