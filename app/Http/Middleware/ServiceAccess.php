<?php

namespace App\Http\Middleware;

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
            session()->flash(
                'message',
                [
                    'content' => __('common.No access'),
                    'type' => 'danger'
                ]
            );
            return redirect('/');
        }

        return $next($request);
    }
}
