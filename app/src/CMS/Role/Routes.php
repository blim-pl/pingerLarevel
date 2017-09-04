<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Śliwiński
 * Date: 28.08.2017
 * Time: 10:17
 */

namespace CMS\Role;


use Illuminate\Support\Facades\Route;

class Routes
{
    public static function webAdmin()
    {
        $controller = 'Admin\RolesController';

        Route::prefix('/roles')->group(function() use ($controller) {
            Route::get('/', $controller . '@index')->name('admin.roles');
            Route::get('/create', $controller . '@create')->name('admin.roles.create');
            Route::get('/{role}/edit', $controller . '@edit')->name('admin.roles.edit');

            Route::patch('/{role}', $controller . '@update')->name('admin.roles.update');
            Route::post('', $controller . '@store')->name('admin.roles.store');
            Route::delete('/{role}', $controller . '@destroy')->name('admin.roles.destroy');
        });
    }
}