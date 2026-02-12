<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Code;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $recruiter = User::create([
            'name' => 'Project Reviewer',
            'email' => 'recruiter@example.com',
            'password' => Hash::make('recruiter123'),
        ]);

        for ($i = 0; $i < 20; $i++) {
            Code::create([
                'user_id' => $recruiter->id,
                'code' => str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT),
            ]);
        }

        $otherUser = User::create([
            'name' => 'Other Developer',
            'email' => 'dev@example.com',
            'password' => Hash::make('password123'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            Code::create([
                'user_id' => $otherUser->id,
                'code' => str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT),
            ]);
        }
    }
}