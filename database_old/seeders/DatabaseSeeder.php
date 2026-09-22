<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@hackathon.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@hackathon.local',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Task::factory()->count(3)->create(['user_id' => $user->id]);
        Task::factory()->count(2)->create(['user_id' => $admin->id]);
    }
}
