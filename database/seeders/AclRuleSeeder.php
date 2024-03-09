<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AclRule;

class AclRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acl_rules = [
            [
                'id' => 1,
                'user_id' => 1,
                'role' => 'super_admin',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'role' => 'agri_expert',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'role' => 'farmer',
                'district' => '',
                'sub_division' => 'Udaipur',
                'created_at' => now()
            ],
        ];
        AclRule::insert($acl_rules);
    }
}
