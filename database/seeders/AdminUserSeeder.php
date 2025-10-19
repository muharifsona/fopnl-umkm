<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fopnl.test'],
            [
                'name' => 'Admin FOPNL',
                'password' => Hash::make('password'), // Change this to a secure password
                'role' => 'Admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'testumkm@fopnl.test'],
            [
                'name' => 'Maju Jaya Kuliner',
                'password' => Hash::make('password'), // Change this to a secure password
                'role' => 'UMKM',
            ]
        );
    }
}
