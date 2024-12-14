<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
use App\Http\Controllers\Audit\AuditController;
USE App\Models\Client;
class SuperAdminPdfController extends Controller
{
    public function generateReportGuestHouseBooking(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        $data = [
            'title' => "Guest House In Progress Pre-Reservations Report",
            'date' => Carbon::now()->format('F j, Y'),
            'bookings' => $bookings,
            'director' => $director->fullname,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.guesthouse.current-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated ongoing guest house pre-reservation(s) pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateReportStaffHouseBooking(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        $data = [
            'title' => "Staff House In Progress Pre-Reservations Report",
            'date' => Carbon::now()->format('F j, Y'),
            'director' => $director->fullname,
            'bookings' => $bookings,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.staffhouse.current-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated ongoing staff house pre-reservation(s) pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateReportDftcBooking(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        $data = [
            'title' => "Dumlao's Farmers Training Center (DFTC) In Progress Pre-Reservations Report",
            'date' => Carbon::now()->format('F j, Y'),
            'bookings' => $bookings,
            'director' => $director->fullname,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.DFTC.current-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated ongoing DFTC pre-reservation(s) pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateReportGuestHouseHistory(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });

        $data = [
            'title' => "Guest House Pre-Reservations History Report",
            'date' => Carbon::now()->format('F j, Y'),
            'bookings' => $bookings,
            'director' => $director->fullname,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.guesthouse.history-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated guest house history pre-reservation pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateReportStaffHouseHistory(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $data = [
            'title' => "Staff House Pre-Reservations History Report",
            'date' => Carbon::now()->format('F j, Y'),
            'bookings' => $bookings,
            'director' => $director->fullname,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.staffhouse.history-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated staff house history pre-reservation pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateReportDftcHistory(){
        $now = Carbon::now('Asia/Manila');
        $director = Client::where('role', 'superAdmin')->first();
        $bookings = DftcBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $data = [
            'title' => "Dumlao's Farmers Training Center (DFTC) Pre-Reservations History Report",
            'date' => Carbon::now()->format('F j, Y'),
            'bookings' => $bookings,
            'director' => $director->fullname,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.DFTC.history-booking', $data)
                   ->setPaper([0, 0, 612, 1008], 'landscape');
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated DFTC history pre-reservation pdf report in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->download(time() . '.pdf');
    }
    public function generateClientGuestHouseBooking(Request $request){
       $bookingData = $request->json()->all();
       $headerHtml = '<div class="container-fluid">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <table class="no-border">
                        <thead>
                            <tr>
                                <th style="text-align: right;">
                                    <img style="width: 80px; height: 80px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/nvsu-logo1.png'))) .'" alt="logo">
                                </th>
                                <th style="text-align: center;" width="80%">
                                    <p style="margin: 0;">Republic of the Philippines</p>
                                    <p style="margin: 0;">Nueva Vizcaya State University</p>
                                    <p style="margin: 0;">Bayombong Campus</p>
                                    <p style="margin: 0;">REQUEST FOR ACCOMODATION AT THE GUEST HOUSE</p>
                                </th>
                                <th style="text-align: left;">
                                    <img style="width: 70px; height: 70px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/bp-logo.png'))) .'" alt="">
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>';
        $totalAmount = $bookingData['total_amount'];
        $videokeRent = $bookingData['videoke_rent'];
        $director = Client::where('role', 'superAdmin')->first();
        $admin = Client::where('role', 'AdminGH')->first();
        $adminFullName = $admin ? $admin->fullname : 'N/A';
        $additionalBedding = $bookingData['additional_bedding'];
        $minusTotalAmount = $totalAmount - ($videokeRent + $additionalBedding);
        $formattedMinusTotalAmount = number_format($minusTotalAmount, 2);
        $data = [
            'title' => 'Guest House Accomodation',
            'bookings' => $bookingData,
            'admin' => $adminFullName,
            'director' => $director->fullname,
            'fullname' => $bookingData['fullname'],
            'GH_date' => $bookingData['GH_date'],
            'GH_number' => $bookingData['GH_number'],
            'position' => $bookingData['position'],
            'activity' => $bookingData['activity'],
            'agency' => $bookingData['agency'],
            'contact' => $bookingData['contact'],
            'address' => $bookingData['address'],
            'check_in_date' => $bookingData['check_in_date'],
            'check_out_date' => $bookingData['check_out_date'],
            'number_of_days' => $bookingData['number_of_days'],
            'number_of_nights' => $bookingData['number_of_nights'],
            'arrival' => $bookingData['arrival'],
            'departure' => $bookingData['departure'],
            'num_of_male' => $bookingData['num_of_male'],
            'num_of_female' => $bookingData['num_of_female'],
            'total_lodgers' => $bookingData['total_lodgers'],
            'room_number' => $bookingData['room_number'],
            'rate' => $bookingData['rate'],
            'total_amount' => $bookingData['total_amount'],
            'videoke_rent' => $bookingData['videoke_rent'],
            'additional_bedding' => $bookingData['additional_bedding'],
            'special_request' => $bookingData['special_request'],
            'formattedMinusTotalAmount' => $formattedMinusTotalAmount,
            'male_guest' => $bookingData['male_guest'],
            'female_guest' => $bookingData['female_guest'],
            'headerHtml' => $headerHtml,
       ];
        $pdf = PDF::loadView('superAdmin.pdf-report.guesthouse.client-pfd-form', $data)
                ->setPaper([0, 0, 612, 1056],)
                ->setOptions([
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
                  'defaultFont' => 'sans-serif',
                ]);
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated a guest house pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('booking.pdf');

    }
    public function generateClientStaffHouseBooking(Request $request){
        $bookingData = $request->json()->all();
        $headerHtml = '<div class="container-fluid">
             <div class="row">
                 <div class="col-md-12 d-flex justify-content-center">
                     <table class="no-border">
                         <thead>
                             <tr>
                                 <th style="text-align: right;">
                                     <img style="width: 80px; height: 80px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/nvsu-logo1.png'))) .'" alt="logo">
                                 </th>
                                 <th style="text-align: center;" width="80%">
                                     <p style="margin: 0;">Republic of the Philippines</p>
                                     <p style="margin: 0;">Nueva Vizcaya State University</p>
                                     <p style="margin: 0;">Bayombong Campus</p>
                                     <p style="margin: 0;">REQUEST FOR ACCOMODATION AT THE STAFF HOUSE</p>
                                 </th>
                                 <th style="text-align: left;">
                                     <img style="width: 70px; height: 70px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/bp-logo.png'))) .'" alt="">
                                 </th>
                             </tr>
                         </thead>
                     </table>
                 </div>
             </div>
         </div>';
         $totalAmount = $bookingData['total_amount'];
         $additionalBedding = $bookingData['additional_bedding'];
         $director = Client::where('role', 'superAdmin')->first();
         $admin = Client::where('role', 'AdminSH')->first();
         $adminFullName = $admin ? $admin->fullname : 'N/A';
         $minusTotalAmount = $totalAmount  - $additionalBedding;
         $formattedMinusTotalAmount = number_format($minusTotalAmount, 2);
         $data = [
             'title' => 'Staff House Accomodation',
             'bookings' => $bookingData,
             'admin' => $adminFullName,
             'director' => $director->fullname,
             'fullname' => $bookingData['fullname'],
             'SH_date' => $bookingData['SH_date'],
             'SH_number' => $bookingData['SH_number'],
             'position' => $bookingData['position'],
             'activity' => $bookingData['activity'],
             'agency' => $bookingData['agency'],
             'contact' => $bookingData['contact'],
             'address' => $bookingData['address'],
             'check_in_date' => $bookingData['check_in_date'],
             'check_out_date' => $bookingData['check_out_date'],
             'number_of_days' => $bookingData['number_of_days'],
             'number_of_nights' => $bookingData['number_of_nights'],
             'arrival' => $bookingData['arrival'],
             'departure' => $bookingData['departure'],
             'num_of_male' => $bookingData['num_of_male'],
             'num_of_female' => $bookingData['num_of_female'],
             'total_lodgers' => $bookingData['total_lodgers'],
             'room_number' => $bookingData['room_number'],
             'rate' => $bookingData['rate'],
             'total_amount' => $bookingData['total_amount'],
             'additional_bedding' => $bookingData['additional_bedding'],
             'special_request' => $bookingData['special_request'],
             'formattedMinusTotalAmount' => $formattedMinusTotalAmount,
             'male_guest' => $bookingData['male_guest'],
             'payment' => $bookingData['payment'],
             'female_guest' => $bookingData['female_guest'],
             'headerHtml' => $headerHtml,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.staffhouse.client-pdf-form', $data)
                 ->setPaper([0, 0, 612, 1056],)
                 ->setOptions([
                   'isHtml5ParserEnabled' => true,
                   'isRemoteEnabled' => true,
                   'defaultFont' => 'sans-serif',
                 ]);
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated a staff house pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('booking.pdf');

     }
     public function generateClientDftcBooking(Request $request){
        $bookingData = $request->json()->all();
        $headerHtml = '<div class="container-fluid">
             <div class="row">
                 <div class="col-md-12 d-flex justify-content-center">
                     <table class="no-border" style="font-size: 14px;">
                         <thead>
                             <tr>
                                 <th style="text-align: right;">
                                     <img style="width: 80px; height: 80px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/nvsu-logo1.png'))) .'" alt="logo">
                                 </th>
                                 <th style="text-align: center;" width="80%">
                                     <p style="margin: 0;">Republic of the Philippines</p>
                                     <p style="margin: 0;">Nueva Vizcaya State University</p>
                                     <p style="margin: 0;">Bayombong Campus</p>
                                     <p style="margin: 0;">REQUEST FOR THE USE OF THE DUMLAO FARMER\'S TRAINING CENTER</p>
                                 </th>
                                 <th style="text-align: left;">
                                     <img style="width: 70px; height: 70px; margin: 0 auto;" src="data:image/png;base64,'. base64_encode(file_get_contents(public_path('images/bp-logo.png'))) .'" alt="">
                                 </th>
                             </tr>
                         </thead>
                     </table>
                 </div>
             </div>
         </div>';
         $jservices = $bookingData['janitor_services'];
         $avservices = $bookingData['av_services'];
         $director = Client::where('role', 'superAdmin')->first();
         $admin = Client::where('role', 'AdminDFTC')->first();
         $adminFullName = $admin ? $admin->fullname : 'N/A';
         $totalAmount = $bookingData['total_amount'];
         $minusTotalAmount = $totalAmount - ($jservices + $avservices);
         $formattedMinusTotalAmount = number_format($minusTotalAmount, 2);
         $data = [
             'title' => 'DFTC Accomodation',
             'bookings' => $bookingData,
             'director' => $director->fullname,
             'admin' => $adminFullName,
             'fullname' => $bookingData['fullname'],
             'DFTC_date' => $bookingData['DFTC_date'],
             'DFTC_number' => $bookingData['DFTC_number'],
             'position' => $bookingData['position'],
             'activity' => $bookingData['activity'],
             'agency' => $bookingData['agency'],
             'contact' => $bookingData['contact'],
             'address' => $bookingData['address'],
             'check_in_date' => $bookingData['check_in_date'],
             'check_out_date' => $bookingData['check_out_date'],
             'number_of_days' => $bookingData['number_of_days'],
             'number_of_nights' => $bookingData['number_of_nights'],
             'arrival' => $bookingData['arrival'],
             'departure' => $bookingData['departure'],
             'num_of_male' => $bookingData['num_of_male'],
             'num_of_female' => $bookingData['num_of_female'],
             'total_lodgers' => $bookingData['total_lodgers'],
             'room_number' => $bookingData['room_number'],
             'rate' => $bookingData['rate'],
             'total_amount' => $bookingData['total_amount'],
             'special_request' => $bookingData['special_request'],
             'formattedMinusTotalAmount' => $formattedMinusTotalAmount,
             'janitor_services' => $bookingData['janitor_services'],
             'av_services' => $bookingData['av_services'],
             'headerHtml' => $headerHtml,
        ];
        $pdf = PDF::loadView('superAdmin.pdf-report.DFTC.client-pdf-form', $data)
                 ->setPaper([0, 0, 612, 1056],)
                 ->setOptions([
                   'isHtml5ParserEnabled' => true,
                   'isRemoteEnabled' => true,
                   'defaultFont' => 'sans-serif',
                 ]);
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Generated a DFTC pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('booking.pdf');

     }
}
