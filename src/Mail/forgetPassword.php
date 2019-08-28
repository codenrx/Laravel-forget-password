<?php

namespace codenrx\forgetpassword\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class forgetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = config('forgetpassword.address');
        $name = config('forgetpassword.name');
        return $this->view('forgetpassword::email')
            ->from($email, $name)
            ->with(['token' => $this->token, 'url' => config('forgetpassword.url')]);
    }
}
