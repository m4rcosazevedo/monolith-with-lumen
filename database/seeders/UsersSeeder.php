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
                "firstname" => "Marcos",
                "lastname" => "P C Azevedo",
                "email" => "marcos.workspace@gmail.com",
                "password" => "123456",
            ]
        ];

        if (!User::get()->count()) {
            foreach ($this->users as $user) {
                User::create($user);
            }
        }
    }
}
