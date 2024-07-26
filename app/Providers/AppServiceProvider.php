<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use App\Models\Clientes68;
use App\Observers\Clientes68Observer;
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

        Clientes68::observe(Clientes68Observer::class);


        //%NEW_OBSERVER%
    }
}
