<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'tester@test.com'],
            [
                'name' => 'Tester',
                'password' => Hash::make('tester123'),
            ]
        );
    }
}
