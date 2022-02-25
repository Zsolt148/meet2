<?php

namespace Database\Seeders;

use App\Models\Meet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('seeders/meets.json');

        if(!file_exists($path)) {
            return;
        }

        $data = file_get_contents($path);

        activity()->disableLogging();

        foreach(json_decode($data)[0]->data as $meet) {

            // quietly so the folder wont create
            $meet = Meet::withoutEvents(function () use ($meet) {
                return Meet::firstOrCreate(
                    [
                        'id' => $meet->id,
                    ], [
                        'is_visible' => $meet->is_visible,
                        'name' => $meet->name,
                        'host' => $meet->host,
                        'type' => $meet->type,
                        'phases' => $meet->phases,
                        'date' => $meet->date,
                        'deadline' => $meet->deadline,
                        'slug' => $meet->slug,
                        'location_id' => $meet->location_id,
                        'contact_id' => $meet->contact_id,
                        'created_at' => $meet->created_at,
                        'updated_at' => $meet->updated_at,
                    ]
                );
            });

            if($meet->wasRecentlyCreated && !$meet->folder) {
                $meet->update(['folder' => meetFolderName($meet)]);
                $meet->save();
            }

        }
        activity()->enableLogging();
    }

    private function getDate($date)
    {
        if(str_contains($date, 'AM')) {
            $pos = strpos($date, 'AM');
            $string = substr($date, $pos - 6, 9);
            $date = str_replace($string, '', $date);
        }

        if(str_contains($date, 'PM')) {
            $pos = strpos($date, 'PM');
            $string = substr($date, $pos - 6, 9);
            $date = str_replace($string, '', $date);
        }

        // run it again if its still has
        if(str_contains($date, 'AM') || str_contains($date, 'PM')) {
            return $this->getDate($date);
        }

        return $date;
    }

    private function getDeadline($deadline)
    {
        return (str_contains($deadline, ':'))
            ? Carbon::createFromFormat('Y.m.d H:i A', $deadline)
            : Carbon::createFromFormat('Y.m.d', $deadline)->format('Y-m-d') . ' 00:00:00';
    }
}
