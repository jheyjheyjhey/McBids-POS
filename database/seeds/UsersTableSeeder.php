<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    public function run(){
        DB::table('users')->insert([
            'name' => "ADMIN",
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'role' => User::USER_ROLE_ADMIN,
        ]);
    }

}