<?php

namespace Database\Seeders;

use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Team;
use Illuminate\Database\Seeder;

class IndividualCompetitorUserBackfillSeeder extends Seeder
{
    public function run()
    {
        $individualTeam = Team::individual();

        if (!$individualTeam) {
            return;
        }

        activity()->disableLogging();

        Competitor::query()
            ->whereTeamId($individualTeam->id)
            ->whereNull('user_id')
            ->chunkById(200, function ($competitors) {
                foreach ($competitors as $competitor) {
                    $userId = Entry::query()
                        ->whereCompetitorId($competitor->id)
                        ->orderByDesc('id')
                        ->value('user_id');

                    if ($userId) {
                        $competitor->user_id = $userId;
                        $competitor->saveQuietly();
                    }
                }
            });

        activity()->enableLogging();
    }
}
