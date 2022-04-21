<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $this->users = [
            [
                "id" => 1,
                "name" => "Marcos P C Azevedo",
                "email" => "marcos.workspace@gmail.com",
                "password" => "h#o6Q3w@",
            ]
        ];

        if (!User::get()->count()) {
            foreach ($this->users as $user) {
                User::create($user);
            }
        }
    }
}
