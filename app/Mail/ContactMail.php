<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    // public $content;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $content
     */
    public function __construct($email)
    {
        $this->email = $email;
        // $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(' sent in Laravel')
            ->from($this->email)
            ->view('contact.mail');
        // ->with([
        //     'email' => $this->email
        // ]);
    }
}
