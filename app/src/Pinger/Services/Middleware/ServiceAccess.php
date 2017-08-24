<?php

namespace Pinger\Services\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ServiceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->service && false === $request->service->isOwner(Auth::user())) {

            flashMessage(__('common.No access'), 'danger');

            return redirect('/');
        }

        return $next($request);
    }
}
