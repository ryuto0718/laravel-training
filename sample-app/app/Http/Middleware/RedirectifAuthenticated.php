<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectifAuthenticated
{
    private const HOMES = [
        'admin' => RouteServiceProvider::ADMIN_HOME,
        '' => RouteServiceProvider::HOME,
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard){
            if(Auth::guard($guard)->check()){
                return redirect(self::HOMES[$guard]);
            }
        }
        return $next($request);
    }
}
