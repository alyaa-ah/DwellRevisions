<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class NewPreReservationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $fullname;
    public $admin;
    public $requestor;
    public $bookingNumber;
    public $facility;
    public $roomNumber;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct($subject, $fullname, $admin, $requestor, $bookingNumber ,$facility, $roomNumber, $status)
    {
        $this->subject = $subject;
        $this->fullname = $fullname;
        $this->admin = $admin;
        $this->requestor = $requestor;
        $this->bookingNumber = $bookingNumber;
        $this->facility = $facility;
        $this->roomNumber = $roomNumber;
        $this->status = $status;
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
            view: 'mail.new-pre-reservation',
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
