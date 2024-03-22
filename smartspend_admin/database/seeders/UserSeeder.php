<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'image' => '',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@smartspend.com',
            'password' => bcrypt('superadmin123'),
            'phone' => '',
            'address' => '',
            'date_of_birth' => '2000-01-01',
            'age' => 0,
            'work' => '', 
            'salary' => '0', 
        ]);
        User::create([
            'role_id' => 2,
            'image' => '',
            'first_name' => 'Normal',
            'last_name' => 'Admin',
            'email' => 'normaladmin@smartspend.com',
            'password' => bcrypt('normaladmin123'),
            'phone' => '',
            'address' => '',
            'date_of_birth' => '2000-01-01',
            'age' => 0,
            'work' => '', 
            'salary' => '0', 
        ]);
        User::create([
            'role_id' => 3,
            'image' => '',
            'first_name' => 'Normal',
            'last_name' => 'User',
            'email' => 'normaluser@smartspend.com',
            'password' => bcrypt('normaluser123'),
            'phone' => '',
            'address' => '',
            'date_of_birth' => '2000-01-01',
            'age' => 0,
            'work' => '', 
            'salary' => '2000', 
        ]);
    }
}
