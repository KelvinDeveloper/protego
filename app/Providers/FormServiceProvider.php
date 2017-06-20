<?php

namespace App\Providers;

use App\Functions\Form;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
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
        App::bind('form', function () {
            return new Form();
        });
    }
}
