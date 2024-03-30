<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\StudentFacade;
use App\Services\StudentService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('student-facade', function () {
            return new StudentService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
