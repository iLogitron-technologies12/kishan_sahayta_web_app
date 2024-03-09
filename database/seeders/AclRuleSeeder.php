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
                'role' => 'admin',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'role' => 'director',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'role' => 'officer',
                'district' => '',
                'sub_division' => 'Udaipur',
                'created_at' => now()
            ],
            [
                'id' => 4,
                'user_id' => 4,
                'role' => 'training_partner_patanjali',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
            [
                'id' => 5,
                'user_id' => 5,
                'role' => 'training_partner_godrej',
                'district' => '',
                'sub_division' => '',
                'created_at' => now()
            ],
        ];
        AclRule::insert($acl_rules);
    }
}
