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
https://laravel.com/docs/5.4/controllers

*/

Route::get('/', 'PagesController@index');

Route::prefix('/pl')->group(function () {

    App::setLocale('pl');

    /**
     * Defaults
     */
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Services
     */
    \Pinger\Services\Routes::web();

    /**
     * Checks - uruchamianie usług
     */
    \Pinger\Checks\Routes::web();

    /**
     * Pages - aliasy stron
     */
    \Pinger\Pages\Routes::web();
});

Route::prefix('/admin')->group(function () {

    App::setLocale('pl');

    Route::group([
        'middleware' => ['auth', 'action.access'],
        'roles' => ['admin']
    ], function () {

        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

        //services
        \Pinger\Services\Routes::webAdmin();

        //Roles
        \CMS\Role\Routes::webAdmin();

        //Users
        \CMS\User\Routes::webAdmin();
    });

});