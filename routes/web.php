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

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

        //services
        Route::get('/services', 'Admin\ServicesController@index')->name('admin.services');
        Route::get('/services/{service}', 'Admin\ServicesController@show')->name('admin.services.show');
        Route::get('/services/{service}/edit', 'Admin\ServicesController@edit')->name('admin.services.edit');

        Route::patch('/services/{service}', 'Admin\ServicesController@update')->name('admin.services.update');
        Route::delete('/services/{service}', 'Admin\ServicesController@destroy')->name('admin.services.destroy');


        //Roles
        Route::get('/roles', 'Admin\RolesController@index')->name('admin.roles');
        Route::get('/roles/create', 'Admin\RolesController@create')->name('admin.roles.create');
        Route::get('/roles/{role}/edit', 'Admin\RolesController@edit')->name('admin.roles.edit');

        Route::patch('/roles/{role}', 'Admin\RolesController@update')->name('admin.roles.update');
        Route::post('/roles', 'Admin\RolesController@store')->name('admin.roles.store');
        Route::delete('/roles/{role}', 'Admin\RolesController@destroy')->name('admin.roles.destroy');

        //Users
        Route::get('/users', 'Admin\UsersController@index')->name('admin.users');
        Route::get('/users/{user}/edit', 'Admin\UsersController@edit')->name('admin.users.edit');

        Route::patch('/users/{user}', 'Admin\UsersController@update')->name('admin.users.update');
        Route::delete('/users/{user}', 'Admin\UsersController@destroy')->name('admin.users.destroy');
    });

});