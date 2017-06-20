<?php

namespace App\Providers;

use App\Functions\Magic;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MagicServiceProvider extends ServiceProvider
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
        App::bind('magic', function () {
            return new Magic();
        });
    }
}
