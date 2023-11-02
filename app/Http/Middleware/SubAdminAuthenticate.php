<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Symfony\Component\HttpFoundation\Response;

class SubAdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->auth->guard('sub_admin')->check()) {
            return redirect()->route('sub_admin.login');
        }
        return $next($request);

    }
}
