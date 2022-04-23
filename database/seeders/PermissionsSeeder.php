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
            [ "id" => 3,  "description" => "Criação de permissão",   "permission" => "permission_create" ],
            [ "id" => 4,  "description" => "Edição de permissão",    "permission" => "permission_edit" ],
            [ "id" => 5,  "description" => "Exclusão de permissão",  "permission" => "permission_delete" ],

            [ "id" => 6,  "description" => "Listagem de regras",     "permission" => "role_index" ],
            [ "id" => 7,  "description" => "Detalhes de regra",      "permission" => "role_show" ],
            [ "id" => 8,  "description" => "Criação de regra",       "permission" => "role_create" ],
            [ "id" => 9,  "description" => "Edição de regra",        "permission" => "role_edit" ],
            [ "id" => 10, "description" => "Exclusão de regra",      "permission" => "role_delete" ],

            [ "id" => 11, "description" => "Listagem de usuários",   "permission" => "user_index" ],
            [ "id" => 12, "description" => "Detalhes de usuário",    "permission" => "user_show" ],
            [ "id" => 13, "description" => "Criação de usuário",     "permission" => "user_create" ],
            [ "id" => 14, "description" => "Edição de usuário",      "permission" => "user_edit" ],
            [ "id" => 15, "description" => "Exclusão de usuário",    "permission" => "user_delete" ],
        ];

        if (!Permission::get()->count()) {
            foreach ($this->permissions as $permission) {
                Permission::create($permission);
            }
        }
    }
}
