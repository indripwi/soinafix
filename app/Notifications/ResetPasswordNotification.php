<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url('/reset-password/' . $this->token);

        return (new MailMessage)
            ->subject('Reset Password Anda')
            ->greeting('Halo,')
            ->line('Kami menerima permintaan untuk reset password akun Anda.')
            ->action('Reset Password', $resetUrl)
            ->line('Link ini hanya berlaku selama 60 menit.')
            ->line('Jika Anda tidak meminta reset, abaikan email ini.');
    }
}
