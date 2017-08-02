<?php

Route::group(['domain' => '{account}.{domain}' . (env('APP_ENV') != 'local' ? '.{tld}' : '')], function()
{
    Route::get('/', 'WebsiteRouteController@index');
});