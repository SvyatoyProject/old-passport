<?php

namespace App\Notifications\Auth;

use App\Mail\Auth\AuthRegisterMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;

class AuthNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return AuthRegisterMail
     */
    public function toMail(mixed $notifiable): AuthRegisterMail
    {
        return new AuthRegisterMail(
            $notifiable,
            $this->verificationUrl($notifiable)
        );
    }
}
