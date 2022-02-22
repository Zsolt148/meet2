<?php

namespace App\Providers;

use App\Models\User;
use App\Role\RoleService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(RoleService $roleService)
    {
        $this->registerPolicies();

        Gate::define('admin', fn(User $user) => $roleService->hasAnyRoleOf($user, 'admin'));
        Gate::define('team-leader', fn(User $user) => $roleService->hasAnyRoleOf($user, 'admin', 'senior_team_leader', 'bm_team_leader'));

    }
}
