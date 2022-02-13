<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\TeamController;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new TeamController())->sync();
    }
}
