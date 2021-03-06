<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/terms-and-conditions', function () {

    return view('auth.terms-and-conditions')->render();
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('test-email', function () {

        $Mail = new \App\Http\Controllers\MailController();
        $Mail->Send([
            'Title' => 'Test Email',
            'To'    => 'kelvin.developer@icloud.com',
        ], 'test-email');
        dd($Mail);
    });

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('/my-account', function () {

        return redirect('/user/' . Auth::user()->id);
    });

    /**
     * Generic methods
     * */
    Route::get('/{Model}', 'RouteController@index');
    Route::get('/{Model}/{id}', 'RouteController@show');
    Route::post('/{Model}/{id}/save', 'CrudController@save');
    Route::delete('/{Model}/{id}/delete', 'CrudController@delete');

    Route::post('/{Model}/{id}/file/upload', 'CrudController@uploadFile');
    Route::post('/{Model}/{id}/file/delete', 'CrudController@deleteFile');
});