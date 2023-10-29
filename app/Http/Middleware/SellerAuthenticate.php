<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class SellerAuthenticate extends Middleware  // copy the authenticate function
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('seller.login');
    }

    protected function authenticate($request, array $guards)
    {
            if ($this->auth->guard('seller')->check()) {
                return $this->auth->shouldUse('seller');
            }

        $this->unauthenticated($request, ['seller']);
    }
}
