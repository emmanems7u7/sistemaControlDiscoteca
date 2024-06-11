<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistroUsuario extends Notification
{
    use Queueable;
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
            'message' => 'Un usuario se ha registrado se debe asignar un rol',
            'action_url' => 'UsuarioRol.show',
            'btn-action' => 'btn btn-warning',
            
            'UserId' => $this->useriD,
        ];
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
