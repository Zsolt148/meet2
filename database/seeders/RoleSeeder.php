<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug' => 'admin',
                'name' => 'Admin',
                'hint' => 'God',
            ],
            [
                'slug' => 'senior_team_leader',
                'name' => 'Senior Team leader',
                'hint' => 'Senior team leader for senior meets',
            ],
            [
                'slug' => 'bm_team_leader',
                'name' => 'BM Team leader',
                'hint' => 'BM team leader for BM meets',
            ],
        ];

        foreach($roles as $key => $role) {
            Role::updateOrCreate(
              [
                  'slug' => $role['slug']
              ], [
                  'name' => $role['name'],
                  'hint' => $role['hint'],
                ]
            );
        }
    }
}
