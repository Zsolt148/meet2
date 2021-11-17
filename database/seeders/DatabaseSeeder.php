<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            User::factory(10)->create();
        }

        $this->call(UserSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(MeetSeeder::class);
    }
}
