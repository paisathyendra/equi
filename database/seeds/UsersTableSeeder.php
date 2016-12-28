<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Company;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@email.com";
        $user->role = 'admin';
        $user->password = bcrypt('admin');
        $user->save();

        $user = new User();
        $user->name = "User One";
        $user->email = "user1@email.com";
        $user->role = 'manager';
        $user->account_type = 'individual';
        $user->password = bcrypt('secret');
        $user->save();

        $user = new User();
        $user->name = "User Two";
        $user->email = "user2@email.com";
        $user->role = 'manager';
        $user->account_type = 'individual';
        $user->password = bcrypt('secret');
        $user->save();

        $user = new User();
        $user->name = "User Three";
        $user->email = "user3@email.com";
        $user->role = 'manager';
        $user->account_type = 'individual';
        $user->password = bcrypt('secret');
        $user->save();
    }
}
