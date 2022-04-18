<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->permissions = [
            [
                "id" => 1,
                "description" => "Listagem de produtos",
                "permission" => "product_index"
            ],
            [
                "id" => 2,
                "description" => "Detalhes de produto",
                "permission" => "product_show"
            ],
            [
                "id" => 3,
                "description" => "Criação de produto",
                "permission" => "product_create"
            ],
            [
                "id" => 4,
                "description" => "Edição de produto",
                "permission" => "product_edit"
            ],
            [
                "id" => 5,
                "description" => "Exclusão de produto",
                "permission" => "product_delete"
            ]
        ];

        if (!Permission::get()->count()) {
            foreach ($this->permissions as $permission) {
                Permission::create($permission);
            }
        }
    }
}
