<?php

namespace App\Providers;

use App\Functions\Element;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ElementServiceProvider extends ServiceProvider
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
        App::bind('element', function () {
            return new Element();
        });
    }
}
