<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Pinger\Pages\Models\Page;
use Illuminate\Support\ServiceProvider;
use Pinger\Services\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.partials.navbarTop', function ($view){
            $view->with('menuTop', (new Page())->menuTop());

            if ($user = Auth::user()) {
                $cnt = $user->servicesCnt();
            } else {
                $cnt = 0;
            }

            $view->with('servicesCnt', $cnt ? $cnt : 0);
        });

        view()->composer('layouts.master', function ($view){
           $view->with('message', session('message'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
