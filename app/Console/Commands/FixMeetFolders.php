<?php

namespace App\Console\Commands;

use App\Models\Meet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FixMeetFolders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meet:fix-folders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixes the meet folder names';

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
        $meets = Meet::query()->get();

        foreach($meets as $meet) {

            // if the new name folder exists and db folder name is not set correctly
            // set it and continue
            if(Storage::disk('local')->exists('meets/' . meetFolderName($meet)) && $meet->folder != meetFolderName($meet)) {
                $meet->update([
                    'folder' => meetFolderName($meet)
                ]);
                continue;
            }

            // if current folder exists
            // but the new folder doesnt exists yet
            // copy and delete it and update the db folder name
            if(
                Storage::disk('local')->exists('meets/' . $meet->folder) &&
                !Storage::disk('local')->exists('meets/' . meetFolderName($meet))
            ) {

                Storage::disk('local')->move('meets/' . $meet->folder, 'meets/' . meetFolderName($meet));
                Storage::disk('local')->deleteDirectory('meets/' . $meet->folder);

                $meet->update([
                    'folder' => meetFolderName($meet)
                ]);

                $count++;
            }
        }

        $this->info('Updated ' . $count . ' meet folders');

        return 0;
    }
}
