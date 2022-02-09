<?php


namespace App\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use function collect;
use function in_array;

class RoleService
{

    /**
     * @param \App\Models\User $user
     *
     * @param array            $roles
     *
     * @return bool
     */
    public function hasAnyRoleOf(User $user, ...$roles)
    {
        $roleSlugs = collect($roles)
            ->map(fn($role) => $role instanceof Role ? $role->slug : $role);

        return $user->roles
            ->pluck('slug')
            ->intersect($roleSlugs)
            ->isNotEmpty();
    }

    /**
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function hasAnyRole(User $user)
    {
        return $user->roles->isNotEmpty();
    }

    /**
     * @param \App\Models\User                                                              $user
     * @param array|\Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Collection $roles
     * @param bool                                                                          $withoutDetaching
     */
    public function syncRoles(User $user, $roles, $withoutDetaching = false)
    {
        Collection::wrap($roles)
            // Optimize key-value pairs for synchronization.
            ->map(function ($roleSlug) {
                return Role::whereSlug($roleSlug)->firstOrFail()->id;
            })
            // Synchronize roles and related actions.
            // This method will drop all non expected roles
            // attached to the user.
            ->tap(fn($expectedRoles) => $user
                ->roles()
                ->sync($expectedRoles->toArray(), !$withoutDetaching)
            );

    }

}
