<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Code;
use App\Services\CodeService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Injects CodeService to ensure business logic consistency and code uniqueness.
     *
     * @param CodeService $codeService
     */
    public function run(CodeService $codeService): void
    {
        $recruiter = User::create([
            'name' => 'Project Reviewer',
            'email' => 'recruiter@example.com',
            'password' => Hash::make('recruiter123'),
        ]);

        for ($i = 0; $i < 20; $i++) {
            Code::create([
                'user_id' => $recruiter->id,
                'code' => $codeService->generateUniqueCode(),
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
                'code' => $codeService->generateUniqueCode(),
            ]);
        }
    }
}