<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-registration')
            ->with('level', 'success')
            ->with('greeting', 'Hello ' . $this->name . '!')
            ->with('introLines', ['An account was created for you at'])
            ->with('actionText', 'Blobler')
            ->with('actionUrl', request()->root())
            ->with('outroLines', ["Please use $this->password as your password and this email address to login"]);
    }
}
