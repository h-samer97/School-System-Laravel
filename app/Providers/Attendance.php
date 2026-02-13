<?php

namespace App\Providers;

use App\Repository\AttendanceRepository;
use App\Repository\IAttendance;
use Illuminate\Support\ServiceProvider;

class Attendance extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IAttendance::class,
            AttendanceRepository::class
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
