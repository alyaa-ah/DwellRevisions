<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class GeneratePasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $subject;
    public $fullname;
    /**
     * Create a new message instance.
     */
    public function __construct($password, $subject, $fullname)
    {
        $this->password = $password;
        $this->subject = $subject;
        $this->fullname = $fullname;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dwellasp@gmail.com' , 'Dwell'),
            replyTo: [
                new Address('dwellasp@gmail.com' , 'Dwell'),
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.generatepasswordmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
