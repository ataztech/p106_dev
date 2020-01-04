<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Permission
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!Auth::check())
        {
            if($request->is('admin/*'))
            {
                return redirect('admin/login');
            }
            else
            {
                return redirect('login');
            }
        }
        if(!$request->user()->hasPermission($role))
        {
            dd('Access Denied');
        }
        return $next($request);
    }
}
