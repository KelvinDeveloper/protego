<?php

Route::group(['domain' => '{account}' . (env('APP_ENV') != 'local' ? '.{tld}' : '')], function()
{
    Route::get('/{param_1?}/{param_2?}/{param_3?}/{param_4?}', 'WebsiteRouteController@build');
    Route::post('/website/mail/send', 'WebsiteRouteController@sendMail');
});