<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $product = auth('seller')->user()->products->find(request()->product);
        if(!$product) return back()->with('error','Unauthorized');
        // if(!$product) return abort(403);
        return $next($request);
    }
}
