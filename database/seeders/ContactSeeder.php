<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
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
                    'id_contacts' => '3',
                    'name' => '-',
                    'phone' => '-',
                    'email' => '-',
                    'created_at' => '2019-12-12 08:09:35',
                    'updated_at' => '2019-12-12 08:09:35',
                ),
            1 =>
                array (
                    'id_contacts' => '4',
                    'name' => 'Kolonics Krisztián',
                    'phone' => '+36209576101',
                    'email' => 'kolonics@kvsc.info',
                    'created_at' => '2020-02-23 13:25:55',
                    'updated_at' => '2020-02-23 13:25:55',
                ),
        );

        foreach($data as $contact) {
            Contact::firstOrCreate(
                [
                    'id' => $contact['id_contacts']
                ], [
                    'name' => $contact['name'],
                    'phone' => $contact['phone'],
                    'email' => $contact['email'],
                    'created_at' => $contact['created_at'],
                    'updated_at' => $contact['updated_at'],
                ]
            );
        }
    }
}
