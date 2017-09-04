<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 28.08.2017
 * Time: 10:26
 */

namespace CMS\User;

use Illuminate\Support\Facades\Route;

class Routes
{
    public static function webAdmin()
    {
        $controller = 'Admin\UsersController';

        Route::prefix('/users')->group(function() use ($controller) {
            Route::get('/', $controller . '@index')->name('admin.users');
            Route::get('/{user}/edit', $controller . '@edit')->name('admin.users.edit');

            Route::patch('/{user}', $controller . '@update')->name('admin.users.update');
            Route::delete('/{user}', $controller . '@destroy')->name('admin.users.destroy');
        });
    }
}