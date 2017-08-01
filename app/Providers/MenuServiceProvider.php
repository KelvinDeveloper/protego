<?php

namespace App\Providers;

use App\Functions\Menu;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('menu', function () {
            return new Menu();
        });
    }
}
