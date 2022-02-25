<?php

namespace Database\Seeders;

use App\Models\Meet;
use App\Models\MeetNews;
use Illuminate\Database\Seeder;

class MeetNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('seeders/meet_news.json');

        if(!file_exists($path)) {
            return;
        }

        $data = file_get_contents($path);

        activity()->disableLogging();

        foreach(json_decode($data)[0]->data as $news) {

            if(!Meet::find($news->meet_id)) {
                continue;
            }

            MeetNews::firstOrCreate(
                [
                    'id' => $news->id
                ], [
                    'meet_id' => $news->meet_id,
                    'body' => $news->body,
                    'created_at' => $news->created_at,
                    'updated_at' => $news->updated_at,
                ]
            );
        }
        activity()->enableLogging();
    }
}
