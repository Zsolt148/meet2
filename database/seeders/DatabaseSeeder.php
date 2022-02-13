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
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            ContactSeeder::class,
            LocationSeeder::class,
            MeetSeeder::class,      // TODO update
            MeetNewsSeeder::class,  // TODO update
            EventSeeder::class,
            TeamSeeder::class,
            CompetitorSeeder::class,
        ]);

        if (App::environment('local')) {
            User::factory(5)->create();
        }
    }
}
