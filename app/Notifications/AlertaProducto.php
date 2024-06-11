<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertaProducto extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected  $useriD;
    /**
     * Create a new notification instance.
     */
    public function __construct($userId)
    {
        $this->useriD =$userId;
    }
    public function via($notifiable)
    {
        return $notifiable->preferredNotificationChannels();
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Habilitar Estudiante')
            ->line('Un estudiante se ha registrado en una materia y necesita ser habilitado.')
            ->action('Habilitar Estudiante', url('/ruta/para/habilitar/estudiante'))
            ->line('Gracias por usar nuestra aplicación!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Algunos Productos estan por terminarse',
            'action_url' => 'productos.index',
            'btn-action' => 'btn btn-danger',

        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
