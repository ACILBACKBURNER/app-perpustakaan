<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pens.ac.id'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas1@pens.ac.id'],
            [
                'name' => 'Petugas Satu',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas2@pens.ac.id'],
            [
                'name' => 'Petugas Dua',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );
    }
}