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

/**
 * Services
 */
\Pinger\Services\Routes::web();

/**
 * Pages
 */
\Pinger\Pages\Routes::web();

/**
 * Checks - uruchamianie usług
 */
Route::prefix('/checks')->group(function(){
    Route::get('/{service}', 'ChecksController@show')->name('checks.show');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
