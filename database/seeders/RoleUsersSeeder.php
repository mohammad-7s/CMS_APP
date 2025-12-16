<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUsersSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
                'role' => 'editor',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Normal User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
