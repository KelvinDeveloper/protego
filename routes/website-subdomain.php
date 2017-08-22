<?php

Route::group(['domain' => '{account}.{domain}' . (env('APP_ENV') != 'local' ? '.{tld}' : '')], function()
{
    Route::get('/{param_1?}/{param_2?}/{param_3?}/{param_4?}', 'WebsiteRouteController@build');
});