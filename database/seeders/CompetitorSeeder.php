<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\CompetitorController;
use Illuminate\Database\Seeder;

class CompetitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new CompetitorController())->sync();
    }
}
