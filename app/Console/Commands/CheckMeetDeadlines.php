<?php

namespace App\Console\Commands;

use App\Models\Meet;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckMeetDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:meet-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for expired meet deadlines';

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
        $meets = Meet::query()
            ->entriable()
            ->whereDate('deadline', '<', Carbon::now())
            ->get();

        $this->info('Updating ' . count($meets) . ' meets');

        $meets->each(function (Meet $meet) {
            $meet->entries()->update([
                'is_final' => true
            ]);
        });

        return 0;
    }
}
