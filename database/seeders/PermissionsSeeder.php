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
            [ "id" => 1,  "description" => "Listagem de permissões", "permission" => "permission_index" ],
            [ "id" => 2,  "description" => "Detalhes de permissão",  "permission" => "permission_show" ],
            [ "id" => 3,  "description" => "Criação de permissão",   "permission" => "permission_store" ],
            [ "id" => 4,  "description" => "Edição de permissão",    "permission" => "permission_update" ],
            [ "id" => 5,  "description" => "Exclusão de permissão",  "permission" => "permission_destroy" ],

            [ "id" => 6,  "description" => "Listagem de regras",     "permission" => "role_index" ],
            [ "id" => 7,  "description" => "Detalhes de regra",      "permission" => "role_show" ],
            [ "id" => 8,  "description" => "Criação de regra",       "permission" => "role_store" ],
            [ "id" => 9,  "description" => "Edição de regra",        "permission" => "role_update" ],
            [ "id" => 10, "description" => "Exclusão de regra",      "permission" => "role_destroy" ],

            [ "id" => 11, "description" => "Listagem de usuários",   "permission" => "user_index" ],
            [ "id" => 12, "description" => "Detalhes de usuário",    "permission" => "user_show" ],
            [ "id" => 13, "description" => "Criação de usuário",     "permission" => "user_store" ],
            [ "id" => 14, "description" => "Edição de usuário",      "permission" => "user_update" ],
            [ "id" => 15, "description" => "Exclusão de usuário",    "permission" => "user_destroy" ],
        ];

        if (!Permission::get()->count()) {
            foreach ($this->permissions as $permission) {
                Permission::create($permission);
            }
        }
    }
}
