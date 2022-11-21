<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Statamic::script('app', 'cp.js');
        date_default_timezone_set('Europe/Zurich');

        Statamic::pushCpRoutes(function () {
            Route::namespace('\App\Http\Controllers')->group(function () {
                require base_path('routes/cp.php');
            });
        });
    }
}
