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
                'name' => 'Super Admin',
                'email' => 'super_admin@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Agri Expert',
                'email' => 'agri_expert@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Farmer',
                'email' => 'farmer@demo.com',
                'mobile_no' => '0000000000',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
        ];

        User::insert($users);
    }
}
