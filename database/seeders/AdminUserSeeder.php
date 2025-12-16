<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // email الذي ظهر في خطأ duplicate
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // غيّره لاحقاً
                'role' => 'admin',
            ]
        );
    }
}
