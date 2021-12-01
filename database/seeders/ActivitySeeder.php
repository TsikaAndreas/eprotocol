<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Activitylog\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['auth-login', 'user-update', 'auth-logout', 'successful-backup',
            'successful-cleanup', 'protocol-cancel', 'create', 'edit', 'add-files', 'delete-file'];
        $faker = Factory::create();
        for ($i=0; $i<10000; $i++){
            Activity::create([
                'log_name' => $data[array_rand($data)],
                'description' => $faker->words(10, true),
                'subject_type' => 'App\Models\User',
                'subject_id' => $faker->randomNumber(2),
                'causer_type' => 'App\Models\User',
                'causer_id' => $faker->randomNumber(2),
                'properties' => ["ip", "192.168.10.1", "agent", "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36"]
            ]);
        }
    }
}
