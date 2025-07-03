<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    protected function redirectTo(Request $request): ?string
    {
        if(! $request->expectsJson()){
            //パスがadmin/から始まる場合、
            //管理者ログイン画面へリダイレクト
            if($request->is('admin/*')){
                return route('admin.create');
            }
            return route('login');
        }
    }
}
