<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    const sex = [
        'male', 'female'
    ];

    const lengths = [
        '25', '50', '100', '200', '400', '800', '1500',
    ];

    const swims = [
        'butterfly',
        'backstroke',
        'breaststroke',
        'freestyle',
    ];

    const relays = [
        '4x25', '4x50', '4x100', '4x200'
    ];

    const relay_swim = [
        'freestyle', 'medley'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::sex as $sex) {
            foreach(self::lengths as $length) {
                foreach(self::swims as $swim) {

                    // 400, 800, 1500 freestyle
                    if($length >= 400 && $swim == 'freestyle') {
                        Event::firstOrCreate([
                            'length' => $length,
                            'sex' => $sex,
                            'swim' => $swim
                        ]);
                    }elseif($length < 400) {
                        Event::firstOrCreate([
                            'length' => $length,
                            'sex' => $sex,
                            'swim' => $swim
                        ]);
                    }
                }
            }

            // Medley
            foreach(['100', '200', '400'] as $length) {
                Event::firstOrCreate([
                    'length' => $length,
                    'sex' => $sex,
                    'swim' => 'medley'
                ]);
            }
        }

        // Relays
        foreach(array_merge(self::sex, ['mix']) as $sex) {
            foreach(self::relays as $length) {
                foreach(self::relay_swim as $swim) {
                    if($length != '4x200' || $swim != 'medley') {
                        Event::firstOrCreate([
                            'length' => $length,
                            'sex' => $sex,
                            'swim' => $swim,
                        ]);
                    }
                }
            }
        }
    }
}
