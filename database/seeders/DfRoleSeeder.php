<?php

namespace Database\Seeders;

use App\Models\Users\UserRole;
use Illuminate\Database\Seeder;

class DfRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::insert([
            [
                'id' => 1,
                'name' => 'USER'
            ],
            [
                'id' => 2,
                'name' => 'ADMIN'
            ],
            [
                'id' => 3,
                'name' => 'MODERATOR'
            ]
        ]);
    }
}
