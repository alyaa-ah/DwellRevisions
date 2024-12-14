<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneratePasswordMail;
use App\Mail\PreReservationMail;
use App\Mail\ReviewMail;
use App\Mail\SuperAdminNotificationMail;
use App\Mail\CancelationNotificationMail;
use App\Mail\NewPreReservationMail;
class EmailController extends Controller
{
    public function sendEmailPassword($toEmail, $password, $fullname){
        $toEmail = $toEmail;
        $fullname = $fullname;
        $password = $password;
        $subject = "Dwell Registration Email";
        Mail::to($toEmail)->send(new GeneratePasswordMail($password, $subject, $fullname));
    }
    public function sendPreReservationNotification($toEmail, $fullname, $requestor, $bookingNumber, $facility, $roomNumber , $checkInDate, $arrival, $checkOutDate, $departure){
        $toEmail = $toEmail;
        $fullname = $fullname;
        $requestor = $requestor;
        $bookingNumber = $bookingNumber;
        $facility = $facility;
        $roomNumber = $roomNumber;
        $checkInDate = $checkInDate;
        $arrival = $arrival;
        $checkOutDate = $checkOutDate;
        $departure = $departure;
        $subject = "Dwell Pre-Reservation Email";
        Mail::to($toEmail)->send(new PreReservationMail($subject, $fullname, $requestor, $bookingNumber, $facility, $roomNumber, $checkInDate, $arrival, $checkOutDate, $departure));
    }
    public function sendReviewNotification($toEmail, $requestor, $bookingNumber, $facility, $roomNumber, $status , $reason){
        $toEmail = $toEmail;
        $requestor = $requestor;
        $bookingNumber = $bookingNumber;
        $facility = $facility;
        $roomNumber = $roomNumber;
        $status = $status;
        $reason = $reason;
        $subject = "Dwell Review Email";
        Mail::to($toEmail)->send(new ReviewMail($subject, $requestor, $bookingNumber, $facility, $roomNumber, $status, $reason));
    }
    public function superAdminNotification($toEmail, $fullname, $requestor, $bookingNumber, $facility, $roomNumber , $checkInDate, $arrival, $checkOutDate, $departure){
        $subject = "Pre-Reservation Mail";
        $toEmail = $toEmail;
        $fullname = $fullname;
        $requestor = $requestor;
        $facility = $facility;
        $roomNumber = $roomNumber;
        $checkInDate = $checkInDate;
        $arrival = $arrival;
        $checkOutDate = $checkOutDate;
        $departure = $departure;
        Mail::to($toEmail)->send(new SuperAdminNotificationMail($subject, $fullname, $requestor, $bookingNumber, $facility, $roomNumber , $checkInDate, $arrival, $checkOutDate, $departure));
    }
    public function sendCanceledNotification($toEmail, $fullname, $requestor, $bookingNumber, $facility, $roomNumber, $status , $reason){
        $toEmail = $toEmail;
        $fullname = $fullname;
        $requestor = $requestor;
        $bookingNumber = $bookingNumber;
        $facility = $facility;
        $roomNumber = $roomNumber;
        $status = $status;
        $reason = $reason;
        $subject = "Dwell Cancellation Email";
        Mail::to($toEmail)->send(new CancelationNotificationMail($subject, $fullname, $requestor, $bookingNumber, $facility, $roomNumber, $status, $reason));
    }
    public function newPreReservation($toEmail, $fullname, $admin, $requestor, $bookingNumber, $facility, $roomNumber, $status){
        $toEmail = $toEmail;
        $fullname = $fullname;
        $admin = $admin;
        $requestor = $requestor;
        $bookingNumber = $bookingNumber;
        $facility = $facility;
        $roomNumber = $roomNumber;
        $status = $status;
        $subject = "Dwell New Reviewed Pre-Reservation Mail";
        Mail::to($toEmail)->send(new NewPreReservationMail($subject, $fullname, $admin, $requestor, $bookingNumber, $facility, $roomNumber, $status));
    }
}
