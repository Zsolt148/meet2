<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\TeamController;
use App\Models\Team;
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

        Team::updateOrCreate(
        	[
				'type' => 'individual',
			], [
//        		'name' => 'Egyéni induló',
        		'name' => 'Individual competitor',
				'short' => 'Egyéni induló',
				'meet_abbr' => 'EGYEN',
				'country' => 'HU',
			]
		);
    }
}
