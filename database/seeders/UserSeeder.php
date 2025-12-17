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
        User::create([
            'name'     => 'Violet',
            'username' => 'violet',
            'password' => Hash::make('violet123'),
            'role'     => 'admin',
        ]);

        // Petugas
        User::create([
            'name'     => 'Joe Doe',
            'username' => 'joe',
            'password' => Hash::make('joe123'),
            'role'     => 'petugas',
        ]);

        // Manajer
        User::create([
            'name'     => 'Charlie Kirk',
            'username' => 'charlie',
            'password' => Hash::make('charlie123'),
            'role'     => 'manajer',
        ]);
    }
}
