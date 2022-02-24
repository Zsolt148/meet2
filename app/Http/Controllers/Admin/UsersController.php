<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UsersRequest;
use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;

class UsersController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(User::query()->with('roles', 'team'), request(), ['name', 'email']);

        if($search = request()->get('search')) {
            $query
                ->orWhereHas('roles', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%');
                })
                ->orWhereHas('team', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%');
                })
            ;
        }

        return Inertia::render('Admin/Users/UsersIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'users' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles', 'team');

        $roles = collect(Role::all())->map(function ($role) use ($user) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'full_name' => $role->full_name,
                'hint' => $role->hint,
                'isSelected' => $user->roles->firstWhere('id', $role->id) ? true : false,
            ];
        });

        return Inertia::render('Admin/Users/UsersEdit', [
            'editUser' => $user,
            'allRoles' => $roles,
            'teams' => Team::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        $user->fill($request->only(
            'name',
            'email',
            'team_id'
        ));

        $user->save();

        $roles = collect($request->roles)->filter(function ($role) {
            return $role['isSelected'];
        })->pluck('name');

        $user->syncRoles($roles);

        return redirect()->route('admin:users.index')->with('success', 'Felhasználó sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin:users.index')->with('success', 'Felhasználó sikeresen törölve');
    }
}
