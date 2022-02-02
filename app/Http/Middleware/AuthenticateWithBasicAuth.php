<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            config('auth.basic.mszuosz')['username'] == $request->getUser() &&
            config('auth.basic.mszuosz')['password'] == $request->getPassword()
        ) {
            return $next($request);
        }

        return response('Unauthorized', 401);
    }
}
