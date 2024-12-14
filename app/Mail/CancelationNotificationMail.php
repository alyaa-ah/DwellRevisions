<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class CancelationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $fullname;
    public $requestor;
    public $facility;
    public $bookingNumber;
    public $roomNumber;
    public $status;
    public $reason;
    /**
     * Create a new message instance.
     */
    public function __construct($subject, $fullname ,$requestor, $bookingNumber , $facility, $roomNumber, $status, $reason)
    {
        $this->subject = $subject;
        $this->fullname = $fullname;
        $this->requestor = $requestor;
        $this->facility = $facility;
        $this->bookingNumber = $bookingNumber;
        $this->roomNumber = $roomNumber;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dwellasp@gmail.com' , 'Dwell Account'),
            replyTo: [
                new Address('dwellasp@gmail.com' , 'Dwell Account'),
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
            view: 'mail.cancellation-mailnotification',
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
