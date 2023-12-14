<?php

namespace App\Console\Commands;

use App\Models\Competitor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixDuplicateCompetitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = 0;
        $dups = DB::table('competitors')
            ->select(['team_id', 'name', 'birth', 'sex', 'type'])
            ->groupBy(['team_id', 'name', 'birth', 'sex', 'type'])
            ->havingRaw('COUNT(id) > 1')
            ->get();

        $this->info(count($dups));

        foreach ($dups as $i => $dup) {

            $comps = Competitor::query()
                ->with('entries')
                ->where('team_id', $dup->team_id)
                ->where('name', $dup->name)
                ->where('birth', $dup->birth)
                ->where('sex', $dup->sex)
                ->where('type', $dup->type)
                ->latest()
                ->get();

            // latest comp
            $latest = $comps->shift();

            foreach ($comps as $competitor) {
                $competitor->entries()->update([
                    'competitor_id' => $latest->id
                ]);

                $count++;
            }

            Competitor::query()
                ->whereIn('id', collect($comps)->pluck('id')->toArray())
                ->delete();
        }

        $this->info("Updated competitors: $count");

        return 0;
    }
}
