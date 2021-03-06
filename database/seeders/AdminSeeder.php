<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Budai Zsolt',
                'email' => 'b.zsolt148@gmail.com',
                'password' => '$2y$10$RTKomZaszHHGhelMjszMIeyn01vqv4dMe0GKKVizXtuDwZ0DN8NCC',
            ],[
                'name' => 'Kolonics Krisztián',
                'email' => 'kolonics@kvsc.info',
                'password' => '$2y$10$StbLrYkjt9cK1G1dWtuGCe743bAKp/GJA5qTU//XQhm0Xt/NNHg5i',
            ],
        ];

        foreach($users as $data) {
            $user = User::firstOrCreate(
                [
                    'email' => $data['email']
                ], [
                    'name' => $data['name'],
                    'password' => $data['password'],
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $user->assignRole('admin');
        }
    }
}
