<?php

namespace App\Mail\Auth;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    private string $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $url)
    {
        $this->user = $user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->view('email.auth.templates.register', [
            'name' => $this->user->name,
            'url' => $this->url
        ])
            ->to($this->user->email)
            ->subject(trans('auth.email.register'));
    }
}
