<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionHasRolesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->adminPermissions = [
            1, 2, 3, 4, 5, // permission permissions
            6, 7, 8, 9, 10, // role permissions
            11, 12, 13, 14, 15 // user permissions
        ];

        $this->managerPermissions = [1, 2, 6, 7, 11, 12];

        Role::find(1)->permissions()->sync($this->adminPermissions);
        Role::find(2)->permissions()->sync($this->managerPermissions);
    }
}
