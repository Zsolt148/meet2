<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // spatie laravel permissions
        // https://spatie.be/docs/laravel-permission/v5/introduction

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            [
                'name' => 'admin',
                'full_name' => 'Admin',
                'hint' => 'God',
            ],
            [
                'name' => 'senior_team_leader',
                'full_name' => 'Senior Team leader',
                'hint' => 'Senior team leader for senior meets',
            ],
            [
                'name' => 'bm_team_leader',
                'full_name' => 'BM Team leader',
                'hint' => 'BM team leader for BM meets',
            ],
        ];

        activity()->disableLogging();
        foreach($roles as $key => $role) {
            Role::create([
                'name' => $role['name'],
                'full_name' => $role['full_name'],
                'hint' => $role['hint']
            ]);
        }
        activity()->enableLogging();
    }
}
