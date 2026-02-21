<?php

namespace App\Providers;

use App\Repository\ILibrary;
use App\Repository\LibraryRepository;
use Illuminate\Support\ServiceProvider;

class Library extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind( 
            ILibrary::class,
            LibraryRepository::class
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
