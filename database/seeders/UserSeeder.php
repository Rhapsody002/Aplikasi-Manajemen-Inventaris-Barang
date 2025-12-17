<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['username' => 'violet'],
            [
                'name'     => 'Violet',
                'password' => Hash::make('violet123'),
                'role'     => 'admin',
            ]
        );

        // Petugas
        User::updateOrCreate(
            ['username' => 'joe'],
            [
                'name'     => 'Joe Doe',
                'password' => Hash::make('joe123'),
                'role'     => 'petugas',
            ]
        );

        // Manajer
        User::updateOrCreate(
            ['username' => 'charlie'],
            [
                'name'     => 'Charlie Kirk',
                'password' => Hash::make('charlie123'),
                'role'     => 'manajer',
            ]
        );
    }
}
