<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(private Task $task)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nueva tarea creada: '.$this->task->title)
            ->greeting("Hola {$notifiable->name},")
            ->line("El usuario {$this->task->user->name} creó una nueva tarea.")
            ->line("Título: {$this->task->title}")
            ->line('Prioridad: '.ucfirst($this->task->priority))
            ->action('Ver panel de administración', config('app.frontend_url', config('app.url')).'/admin');
    }
}
