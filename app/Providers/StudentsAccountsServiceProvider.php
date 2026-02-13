<?php

namespace App\Providers;

use App\Repository\IStudent;
use App\Repository\IStudentsAccounts;
use App\Repository\StudentsAccountsRepository;
use Illuminate\Support\ServiceProvider;

class StudentsAccountsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->bind(
                    IStudentsAccounts::class,
                    StudentsAccountsRepository::class
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
