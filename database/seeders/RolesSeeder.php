<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->roles = [
            [
                "id" => 1,
                "description" => "Administrator"
            ],
            [
                "id" => 2,
                "description" => "Manager"
            ]
        ];

        if (!Role::get()->count()) {
            foreach ($this->roles as $role) {
                Role::create($role);
            }
        }
    }
}
