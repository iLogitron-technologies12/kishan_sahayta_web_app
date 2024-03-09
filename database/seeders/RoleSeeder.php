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
        $roles_and_codes = [
            [
                'id' => 1,
                'code' => 'super_admin',
                'role' => 'Super Admin',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'code' => 'agri_expert',
                'role' => 'Agri Expert',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'code' => 'farmer',
                'role' => 'Farmer',
                'created_at' => now()
            ],
            ];
            Roles::insert($roles_and_codes);
    }
}
