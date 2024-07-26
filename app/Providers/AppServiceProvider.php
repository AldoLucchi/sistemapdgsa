<?php

namespace App\Providers;

use App\Core\KTBootstrap;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

//%NEW_OBSERVER_USE%

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
        Schema::defaultStringLength(191);

        // Update defaultStringLength
        Builder::defaultStringLength(191);

        KTBootstrap::init();


        require __DIR__ . '/AppServiceProvider_observer.php';
        //%NEW_OBSERVER%
    }
}
