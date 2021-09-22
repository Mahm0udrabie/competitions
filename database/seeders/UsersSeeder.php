<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = [
            'name' => 'superAdmin',
            'email' => 'superadmin@site.com',
            'password'=> bcrypt(12345678),
        ];
        $user = User::create($superAdmin);
        $user->attachRole(1);

        $admin = [
            'name' => 'admin',
            'email' => 'admin@site.com',
            'password'=> bcrypt(12345678),
        ];
        $user = User::create($admin);
        $user->attachRole(2);

        $normal = [
            'name' => 'user',
            'email' => 'user@site.com',
            'password'=> bcrypt(12345678),
        ];
        $user = User::create($normal);
        $user->attachRole(3);

    }
}
