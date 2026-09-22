<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskCreatedNotification;

/**
 * Toda la lógica de negocio de Task vive aquí (SRP).
 * El controlador solo orquesta HTTP <-> este servicio.
 */
class TaskService
{
    public function listForUser(User $user)
    {
        return Task::query()
            ->forUser($user)
            ->latest()
            ->get();
    }

    public function create(User $user, array $data): Task
    {
        $task = Task::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'status' => $data['status'] ?? 'pending',
            'priority' => $data['priority'] ?? 'medium',
        ]);

        $this->notifyAdmins($task);

        return $task;
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task->refresh();
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }

    private function notifyAdmins(Task $task): void
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new TaskCreatedNotification($task));
        }
    }
}
