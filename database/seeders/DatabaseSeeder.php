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

        // Crear tareas directamente para el usuario normal
        Task::create([
            'user_id' => $user->id,
            'title' => 'Primera tarea de prueba',
            'description' => 'Descripción de la tarea número uno',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Segunda tarea de prueba',
            'description' => 'Descripción de la tarea número dos',
            'status' => 'in_progress',
            'priority' => 'high',
        ]);

        // Crear tareas para el administrador
        Task::create([
            'user_id' => $admin->id,
            'title' => 'Tarea administrativa',
            'description' => 'Revisar reportes de la hackathon',
            'status' => 'pending',
            'priority' => 'high',
        ]);
    }
}
