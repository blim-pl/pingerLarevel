<?php
namespace Pinger\Services;

use Illuminate\Support\Facades\Route;

/**
 * Routes from Services package
 *
 * Class Routes
 *
 * @package Pinger\Services
 */
class Routes
{
    /**
     * Routes should be run in routes\web.php
     */
    public static function web()
    {
        $controller = 'ServicesController';

        Route::prefix('/services')->group(function () use ($controller) {

            Route::get('/', $controller . '@index')->name('services.index');
            Route::get('/create', $controller . '@create')->name('services.create');
            Route::post('/', $controller . '@store')->name('services.store');

            Route::group(['middleware' => ['service.access']], function() use ($controller) {
                Route::get('/{service}', $controller . '@show')->name('services.show');
                Route::get('/{service}/edit', $controller . '@edit')->name('services.edit');

                Route::patch('/{service}', $controller . '@update')->name('services.update');
                Route::delete('/{service}', $controller . '@destroy')->name('services.destroy');
            });
        });
    }
}