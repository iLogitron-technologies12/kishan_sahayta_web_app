<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles_and_Permissions\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'code' => 'admin',
                'role' => 'Admin',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'code' => 'director',
                'role' => 'Director',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'code' => 'officer',
                'role' => 'Officer',
                'created_at' => now()
            ],
            [
                'id' => 4,
                'code' => 'training_partner_patanjali',
                'role' => 'Training Partner Patanjali',
                'created_at' => now()
            ],
            [
                'id' => 5,
                'code' => 'training_partner_godrej',
                'role' => 'Training Partner Godrej',
                'created_at' => now()
            ],
            [
                'id' => 6,
                'code' => 'citizen',
                'role' => 'Citizen',
                'created_at' => now()
            ],
            ];
            Roles::insert($permissions);
    }
}
