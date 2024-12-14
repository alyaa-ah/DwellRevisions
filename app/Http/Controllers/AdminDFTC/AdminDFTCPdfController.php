<?php

namespace App\Http\Controllers\AdminDFTC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Audit\AuditController;
use App\Models\Client;
class AdminDFTCPdfController extends Controller
{
    public function generateGuestHousePdfAdminDftc(Request $request){
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
             'director' => $director->fullname,
             'admin' => $adminFullName,
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
        $pdf = PDF::loadView('adminDftc.pdf-form.guesthouse-booking', $data)
                 ->setPaper([0, 0, 612, 1056],)
                 ->setOptions([
                   'isHtml5ParserEnabled' => true,
                   'isRemoteEnabled' => true,
                   'defaultFont' => 'sans-serif',
                 ]);
        $clientId = session()->get('loggedInAdminDftc')['id'];
        $fullname = session()->get('loggedInAdminDftc')['fullname'];
        $role = session()->get('loggedInAdminDftc')['role'];
        $activity = "Generated a guest house pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('guesthouse-form.pdf');
    }
    public function generateStaffHousePdfAdminDftc(Request $request){
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
             'director' => $director->fullname,
             'admin' => $adminFullName,
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
        $pdf = PDF::loadView('adminDftc.pdf-form.staffhouse-booking', $data)
                 ->setPaper([0, 0, 612, 1056],)
                 ->setOptions([
                   'isHtml5ParserEnabled' => true,
                   'isRemoteEnabled' => true,
                   'defaultFont' => 'sans-serif',
                 ]);
        $clientId = session()->get('loggedInAdminDftc')['id'];
        $fullname = session()->get('loggedInAdminDftc')['fullname'];
        $role = session()->get('loggedInAdminDftc')['role'];
        $activity = "Generated a staff house pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('staffhouse-form.pdf');
    }
    public function generateDftcBookingAdminDftc(Request $request){
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
        $pdf = PDF::loadView('adminDftc.pdf-form.dftc-booking', $data)
                 ->setPaper([0, 0, 612, 1056],)
                 ->setOptions([
                   'isHtml5ParserEnabled' => true,
                   'isRemoteEnabled' => true,
                   'defaultFont' => 'sans-serif',
                 ]);
        $clientId = session()->get('loggedInAdminDftc')['id'];
        $fullname = session()->get('loggedInAdminDftc')['fullname'];
        $role = session()->get('loggedInAdminDftc')['role'];
        $activity = "Generated a DFTC pdf form in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $pdf->stream('booking.pdf');
     }
}
