<?php
namespace Pinger\Pages;

use Illuminate\Support\Facades\Route;

/**
 * Routes from Pages package
 *
 * Class Routes
 *
 * @package Pinger\Pages
 */
class Routes
{
    /**
     * Routes should be run in routes\web.php
     */
    public static function web()
    {
        $controller = 'PagesController';

        Route::prefix('/pages')->group(function () use ($controller) {
            Route::get('/', $controller . '@index')->name('pages.index');
            Route::get('/create', $controller . '@create')->name('pages.create');
            Route::get('/{page}', $controller . '@show')->name('pages.show');
            Route::get('/{page}/edit', $controller . '@edit')->name('pages.edit');

            Route::post('/', $controller . '@store');
            Route::patch('/{page}', $controller . '@update');
            Route::delete('/{page}', $controller . '@destroy');
        });

        Route::get('/{alias}', $controller . '@showByAlias')->name('pages.show');
    }
}