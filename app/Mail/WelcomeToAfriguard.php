<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeToAfriguard extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * The user instance.
     *
     * @var \App\User
     */

    public $user;

    public $url;

    /**
     * Create a new message instance.
     *
     * @param \App\User $user
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
    public function build()
    {
        return $this->subject('Welcome to AfriGuard 💙 Please Verify Your Email')->markdown('emails.welcome')->with([ 'user' => $this->user, 'url'  => $this->url, ]);;
    }
    
}
