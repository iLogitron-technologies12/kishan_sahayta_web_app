<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Director',
                'email' => 'director@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Officer',
                'email' => 'officer@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Training Partner Patanjali',
                'email' => 'tp.patanjali@demo.com',
                'mobile_no' => '1111111111',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Training Partner Godrej',
                'email' => 'tp.godrej@demo.com',
                'mobile_no' => '1111111111',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
        ];

        User::insert($users);
    }
}
