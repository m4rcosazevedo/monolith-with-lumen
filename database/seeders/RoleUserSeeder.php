<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->roleUsers = [
            [
                "role_id" => 1,
                "user_id" => 1
            ]
        ];

        User::find(1)->roles()->attach($this->roleUsers);
    }
}
