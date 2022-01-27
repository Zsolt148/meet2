<?php

namespace App\Observers;

use App\Models\Meet;
use Illuminate\Support\Facades\Storage;

class MeetObserver
{
    /**
     * Handle the Meet "created" event.
     *
     * @param  \App\Models\Meet  $meet
     * @return void
     */
    public function created(Meet $meet)
    {
        if(!$this->pathExists($meet)) {
            Storage::makeDirectory('meets' . DIRECTORY_SEPARATOR . $meet->folder);
        }
    }

    /**
     * Handle the Meet "updated" event.
     *
     * @param  \App\Models\Meet  $meet
     * @return void
     */
    public function updated(Meet $meet)
    {
        if(!$this->pathExists($meet)) {
            Storage::makeDirectory('meets' . DIRECTORY_SEPARATOR . $meet->folder);
        }
    }

    /**
     * Handle the Meet "deleted" event.
     *
     * @param  \App\Models\Meet  $meet
     * @return void
     */
    public function deleted(Meet $meet)
    {
        if($this->pathExists($meet) && $meet->folder) {
            Storage::deleteDirectory('meets' . DIRECTORY_SEPARATOR . $meet->folder);
        }
    }

    /**
     * Handle the Meet "restored" event.
     *
     * @param  \App\Models\Meet  $meet
     * @return void
     */
    public function restored(Meet $meet)
    {
        //
    }

    /**
     * Handle the Meet "force deleted" event.
     *
     * @param  \App\Models\Meet  $meet
     * @return void
     */
    public function forceDeleted(Meet $meet)
    {
        //
    }

    /**
     * @param Meet $meet
     * @return bool
     */
    private function pathExists(Meet $meet)
    {
        return Storage::exists('meets' . DIRECTORY_SEPARATOR . $meet->folder);
    }
}
