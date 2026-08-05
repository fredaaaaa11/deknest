<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@deknest.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@deknest.com',
                'password' => Hash::make('12345678'),
                'is_admin' => true,
            ]
        );
    }
}