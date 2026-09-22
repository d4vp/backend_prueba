<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('¡Bienvenido a Hackathon Base!')
            ->greeting("Hola {$notifiable->name},")
            ->line('Tu cuenta se creó correctamente.')
            ->line('Ya puedes iniciar sesión y empezar a crear tareas.')
            ->action('Ir a la aplicación', config('app.frontend_url', config('app.url')))
            ->line('Gracias por unirte al proyecto.');
    }
}
