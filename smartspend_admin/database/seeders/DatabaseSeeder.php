<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\RiskAssessment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(RiskAssessmentChoiceSeeder::class);
        $this->call(RiskAssessmentSeeder::class);
    }
}
