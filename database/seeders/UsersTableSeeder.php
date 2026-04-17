<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'testuser';
        $user->email = 'testuser@test.com';
        $user->password = bcrypt('secret');
        $user->role = 'admin';
        $user->save();

        $user2 = new User();
        $user2->name = 'testuser';
        $user2->email = 'testuser2@test.com';
        $user2->password = bcrypt('secret');
        $user2->role = 'user';
        $user2->save();

    }
}
