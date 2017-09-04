<?php

namespace CMS\Role\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ActionAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null){
            return redirect('/login');
        }

        $roles = $request->route()->getAction()['roles'];

        if(!empty($roles) && !$request->user()->hasAccess($roles)){
            flashMessage(__('common.No access'), 'danger');
            return redirect('/' . App::getLocale() . '/login');
        }

        return $next($request);
    }
}
