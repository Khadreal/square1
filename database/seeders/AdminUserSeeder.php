<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            'name' => 'Admin',
            'username' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => 'password',
            'role' => 'admin'
        ];

        User::create( $userData );
    }
}
