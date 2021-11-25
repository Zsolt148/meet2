<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UsersRequest;
use App\Models\User;
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
        $query = $this->getQuery(User::class, request(), ['name', 'email', 'role']);

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
        return Inertia::render('Admin/Users/UsersEdit', [
            'editUser' => $user,
            'roles' => User::ROLES,
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
        $user->update($request->all());

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
