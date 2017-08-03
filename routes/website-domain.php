<?php

Route::group(['domain' => '{account}' . (env('APP_ENV') != 'local' ? '.{tld}' : '')], function()
{
    Route::get('/', 'WebsiteRouteController@index');
});