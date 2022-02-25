<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array (
            0 =>
                array (
                    'id_locations' => '1',
                    'city' => 'Kecskemét',
                    'address' => 'Csabay Géza krt. 5,',
                    'pool' => '50',
                    'timing' => 'Colorado',
                    'created_at' => '2019-11-25 10:24:32',
                    'updated_at' => '2019-11-25 10:24:32',
                ),
            1 =>
                array (
                    'id_locations' => '5',
                    'city' => 'Budapest',
                    'address' => 'Népfürdő u. 36',
                    'pool' => '50',
                    'timing' => 'Omega',
                    'created_at' => '2019-11-12 12:24:45',
                    'updated_at' => '2019-11-12 12:24:45',
                ),
            2 =>
                array (
                    'id_locations' => '6',
                    'city' => 'Hódmezővásárhely',
                    'address' => 'Ady Endre út 1',
                    'pool' => '50',
                    'timing' => 'Omega',
                    'created_at' => '2020-02-04 06:49:49',
                    'updated_at' => '2020-02-04 06:49:49',
                ),
            3 =>
                array (
                    'id_locations' => '7',
                    'city' => 'Eger',
                    'address' => 'Frank Tivadar u. 5',
                    'pool' => '50',
                    'timing' => 'Colorado',
                    'created_at' => '2021-09-10 04:47:58',
                    'updated_at' => '2021-09-10 04:47:58',
                ),
        );

        activity()->disableLogging();
        foreach($data as $contact) {
            Location::firstOrCreate(
                [
                    'id' => $contact['id_locations']
                ], [
                    'city' => $contact['city'],
                    'address' => $contact['address'],
                    'pool' => $contact['pool'],
                    'timing' => $contact['timing'],
                    'created_at' => $contact['created_at'],
                    'updated_at' => $contact['updated_at'],
                ]
            );
        }
        activity()->enableLogging();
    }
}
