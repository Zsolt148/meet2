<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactorIsEnabled
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Ha be van jelentkezve, de nincs 2FA és nem a 2FA beállító oldalon van éppen
        if ($user && !$user->two_factor_secret && !$request->routeIs('two-factor.setup', 'two-factor.setup-link', 'logout')) {
            return redirect()->route('two-factor.setup');
        }

        return $next($request);
    }
}
