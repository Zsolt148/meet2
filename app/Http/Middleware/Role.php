<?php

namespace App\Http\Middleware;

use App\Role\RoleService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    protected $roleService;

    /**
     * Role constructor.
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::user() && $this->roleService->hasAnyRoleOf(Auth::user(), $role)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
