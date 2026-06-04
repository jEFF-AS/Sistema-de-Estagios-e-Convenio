<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria o usuário Administrador inicial utilizando o Argon2id
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@atenas.com',
            'password' => Hash::make('admin@123'),
            'role' => 'admin',
        ]);
    }
}
