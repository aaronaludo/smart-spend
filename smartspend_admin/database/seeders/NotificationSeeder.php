<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'id' => 1,
            'user_id' => 3,
            'title' => 'test_title_1',
            'description' => 'test_description_1',
            'date' => now()
        ]);
        Notification::create([
            'id' => 2,
            'user_id' => 3,
            'title' => 'test_title_2',
            'description' => 'test_description_2',
            'date' => now()
        ]);
        Notification::create([
            'id' => 3,
            'user_id' => 3,
            'title' => 'test_title_3',
            'description' => 'test_description_3',
            'date' => now()
        ]);
    }
}
