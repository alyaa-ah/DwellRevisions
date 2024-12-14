<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class SuperAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $fullname;
    public $requestor;
    public $bookingNumber;
    public $facility;
    public $roomNumber;
    public $checkInDate;
    public $arrival;
    public $checkOutDate;
    public $departure;
    /**
     * Create a new message instance.
     */
    public function __construct($subject, $fullname, $requestor, $bookingNumber, $facility, $roomNumber , $checkInDate, $arrival, $checkOutDate, $departure)
    {
        $this->subject = $subject;
        $this->fullname = $fullname;
        $this->requestor = $requestor;
        $this->bookingNumber = $bookingNumber;
        $this->facility = $facility;
        $this->roomNumber = $roomNumber;
        $this->checkInDate = $checkInDate;
        $this->arrival = $arrival;
        $this->checkOutDate = $checkOutDate;
        $this->departure = $departure;
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
            view: 'mail.superadmin-notificationmail',
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
