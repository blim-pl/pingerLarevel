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
 * Checks - uruchamianie usług
 */
Route::prefix('/checks')->group(function(){
    Route::get('/{service}', 'ChecksController@show')->name('checks.show');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Pages - aliasy stron
 */
\Pinger\Pages\Routes::web();

//dd(Route::has('login'));
//
//$routes = Route::getRoutes();
//echo '<pre>';
//print_r(get_class_methods($routes));
//dd($routes->hasNamedRoute('home'));
//echo Route::getPath();
//
//$routes = \Illuminate\Routing\Router::getRoutes();
//dd($routes);
//var_dump($routes->getByName('checks.show1'));
//
//echo url('pages.index');
//dd(get_class_methods($routes));
//dd($routes);
//die();