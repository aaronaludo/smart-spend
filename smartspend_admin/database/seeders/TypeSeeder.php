<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'id' => 1,
            'name' => 'Expected',
        ]);
        Type::create([
            'id' => 2,
            'name' => 'Not Expected',
        ]);
    }
}
