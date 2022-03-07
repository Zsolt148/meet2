<?php

namespace App\Policies\Portal;

use App\Models\Competitor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CompetitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Competitor $competitor)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('team-leader');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Competitor $competitor)
    {
        return Gate::allows('team-leader') &&
            $user->competitors() &&
            $user->competitors()->find($competitor->id)
			&& $user->hasTeam();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Competitor $competitor)
    {
        return Gate::allows('team-leader') &&
            $user->competitors() &&
            $user->competitors()->find($competitor->id)
			&& $user->hasTeam();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Competitor $competitor)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Competitor $competitor)
    {
        //
    }
}
