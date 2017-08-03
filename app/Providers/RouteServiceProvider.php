<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $domain    = isset($_SERVER['HTTP_HOST']) ? explode('.', $_SERVER['HTTP_HOST'] ) : false;
        $subdomain = false;

        if (count($domain) > 1) {

            $subdomain = true;
        }

        if ($domain && is_array($domain) ) {

            $domain = array_shift($domain);
        }

        if ( ! $domain || $domain == 'protego' ) {

            $this->mapWebRoutes();
        } else {

            $this->mapWebsiteRoutes($subdomain);
        }

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "website" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebsiteRoutes($subdomain)
    {

        if ( $subdomain ) {

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/website-subdomain.php'));
        } else {

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/website-domain.php'));
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
