<?php

namespace App\Providers;

use App\Models\Competitor;
use App\Models\Entry;
use App\Models\User;
use App\Policies\Portal\CompetitorPolicy;
use App\Policies\Portal\EntryPolicy;
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
        Entry::class        => EntryPolicy::class,
        Competitor::class   => CompetitorPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', fn(User $user) => $user->hasRole('admin'));
        Gate::define('team-leader', fn(User $user) => $user->hasAnyRole('admin', 'senior_team_leader', 'bm_team_leader'));

    }
}
