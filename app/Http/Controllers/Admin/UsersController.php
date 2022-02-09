<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UsersRequest;
use App\Models\Role;
use App\Models\User;
use App\Role\RoleService;
use Inertia\Inertia;

class UsersController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(User::query()->with('roles'), request(), ['name', 'email']);

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
        $user->load('roles');

        $roles = collect(Role::all())->map(function ($role) use ($user) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'slug' => $role->slug,
                'hint' => $role->hint,
                'isSelected' => $user->roles->firstWhere('id', $role->id) ? true : false,
            ];
        });

        return Inertia::render('Admin/Users/UsersEdit', [
            'editUser' => $user,
            'allRoles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user, RoleService $roleService)
    {
        $user->update($request->only(
            'name',
            'email'
        ));

        $roles = collect($request->roles)->filter(function ($role) {
            return $role['isSelected'];
        })->pluck('slug');

        $roleService->syncRoles($user, $roles);

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
