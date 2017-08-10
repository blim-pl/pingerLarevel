<?php
namespace Pinger\Checks;

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
        $controller = 'ChecksController';

        Route::prefix('/checks')->group(function () use ($controller) {
            Route::group(['middleware' => 'service.access'], function () use ($controller) {
                Route::get('/{service}', $controller . '@show')->name('checks.show');
            });
        });
    }
}