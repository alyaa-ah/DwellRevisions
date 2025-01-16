<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\GuestHouseBooking;
use App\Rules\GuestsRequired;
use App\Rules\GuestsRequireFemale;
use App\Models\StaffHouseBooking;
use App\Models\Room;
use App\Models\DftcBooking;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Audit\AuditController;
use App\Models\Facility;
use App\Models\Client;
class ClientBookingController extends Controller
{
    public function storeGuestHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $maleGuestsArray = isset($request->maleGuests) && $request->maleGuests
            ? (is_array($request->maleGuests)
                ? array_map('trim', $request->maleGuests)
                : array_map('trim', explode(',', $request->maleGuests)))
            : []; // Default empty if null/empty

            // Process female guests safely - handle null & clean data
            $femaleGuestsArray = isset($request->femaleGuests) && $request->femaleGuests
            ? (is_array($request->femaleGuests)
                ? array_map('trim', $request->femaleGuests)
                : array_map('trim', explode(',', $request->femaleGuests)))
            : []; // Default empty if null/empty

            // Remove empty strings
            $maleGuestsArray = array_filter($maleGuestsArray, fn($val) => $val !== '');
            $femaleGuestsArray = array_filter($femaleGuestsArray, fn($val) => $val !== '');


            $client_id = session()->get('loggedInCustomer')['id'];
            $guestHouseBooking = new GuestHouseBooking();
            $guestHouseBooking->client_id = $client_id;
            $guestHouseBooking->room_id = $room->id;
            $guestHouseBooking->room_number = $room->room_number;
            $guestHouseBooking->GH_number = $this->generateGHNumber();
            $guestHouseBooking->GH_date = $formattedDateTime;
            $guestHouseBooking->fullname = $request->fullname;
            $guestHouseBooking->position = $request->position;
            $guestHouseBooking->agency = $request->agency;
            $guestHouseBooking->contact = $request->contactnumber;
            $guestHouseBooking->address = $request->address;
            $guestHouseBooking->email = $request->email;
            $guestHouseBooking->activity = ucfirst($finalActivity);
            $guestHouseBooking->number_of_days = $request->numberOfDays;
            $guestHouseBooking->number_of_nights = $request->numberOfNights;
            $guestHouseBooking->check_in_date = $checkInDate;
            $guestHouseBooking->check_out_date = $checkOutDate;
            $guestHouseBooking->arrival = $arrival;
            $guestHouseBooking->status = "Pending Review";
            $guestHouseBooking->departure = $departure;
            $guestHouseBooking->rate = $request->rate;
            $guestHouseBooking->videoke_rent = $request->rent;
            $guestHouseBooking->additional_bedding = $request->bedding * 100;
            if($request->totalAmount == "FREE"){
                $guestHouseBooking->total_amount = 0;
            }else{
                $guestHouseBooking->total_amount = $request->totalAmount;
            }
            $guestHouseBooking->num_of_male = $request->numOfMale;
            $guestHouseBooking->num_of_female = $request->numOfFemale;
            $guestHouseBooking->total_lodgers = $request->numOfMale + $request->numOfFemale;
            $guestHouseBooking->male_guest = implode(',', array_values($maleGuestsArray));
            $guestHouseBooking->female_guest = implode(',', array_values($femaleGuestsArray));
            $guestHouseBooking->special_request = ucfirst($request->specialRequests);
            $guestHouseBooking->save();
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Added a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            $facility = Facility::where('facility_name', 'Guest House')->first();
            $admin = Client::where('role', 'AdminGH')->first();
            if($admin){
                (new EmailController)->sendPreReservationNotification(
                    $admin->email,
                    $admin->fullname,
                    $guestHouseBooking->fullname,
                    $guestHouseBooking->GH_number,
                    $facility->facility_name,
                    $guestHouseBooking->room_number,
                    $guestHouseBooking->check_in_date,
                    $guestHouseBooking->arrival,
                    $guestHouseBooking->departure,
                    $guestHouseBooking->check_out_date);
            }
            return !is_null($guestHouseBooking) ? 1 : 0;
        }
    }
    private function generateGHNumber(){
        $currentYear = Carbon::now()->year;
        $latestGHNumber = GuestHouseBooking::whereYear('created_at', $currentYear)
                            ->orderBy('GH_number', 'desc')
                            ->pluck('GH_number')
                            ->first();
        if (!$latestGHNumber) {
            return $currentYear . '-001';
        }
        $numberPart = intval(substr($latestGHNumber, -3)) + 1;
        $paddedNumber = str_pad($numberPart, 3, '0', STR_PAD_LEFT);
        return $currentYear . '-' . $paddedNumber;
    }
    public function storeStaffHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_numberStaffHouse' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
            'payment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_numberStaffHouse);
            $client_id = session()->get('loggedInCustomer')['id'];
            $maleGuestsArray = isset($request->maleGuests) && $request->maleGuests
            ? (is_array($request->maleGuests)
                ? array_map('trim', $request->maleGuests)
                : array_map('trim', explode(',', $request->maleGuests)))
            : []; // Default empty if null/empty

            // Process female guests safely - handle null & clean data
            $femaleGuestsArray = isset($request->femaleGuests) && $request->femaleGuests
            ? (is_array($request->femaleGuests)
                ? array_map('trim', $request->femaleGuests)
                : array_map('trim', explode(',', $request->femaleGuests)))
            : []; // Default empty if null/empty

            // Remove empty strings
            $maleGuestsArray = array_filter($maleGuestsArray, fn($val) => $val !== '');
            $femaleGuestsArray = array_filter($femaleGuestsArray, fn($val) => $val !== '');
            $staffHouseBooking = new StaffHouseBooking();
            $staffHouseBooking->client_id = $client_id;
            $staffHouseBooking->room_id = $room->id;
            $staffHouseBooking->room_number = $request->room_numberStaffHouse;
            $staffHouseBooking->SH_number = $this->generateSHNumber();
            $staffHouseBooking->SH_date = $formattedDateTime;
            $staffHouseBooking->fullname = $request->fullname;
            $staffHouseBooking->position = $request->position;
            $staffHouseBooking->agency = $request->agency;
            $staffHouseBooking->contact = $request->contactnumber;
            $staffHouseBooking->address = $request->address;
            $staffHouseBooking->room_number = $room->room_number;
            $staffHouseBooking->email = $request->email;
            $staffHouseBooking->activity = ucfirst($finalActivity);
            $staffHouseBooking->number_of_days = $request->numberOfDays;
            $staffHouseBooking->number_of_nights = $request->numberOfNights;
            $staffHouseBooking->check_in_date = $checkInDate;
            $staffHouseBooking->check_out_date = $checkOutDate;
            $staffHouseBooking->arrival = $arrival;
            $staffHouseBooking->status = "Pending Review";
            $staffHouseBooking->departure = $departure;
            $staffHouseBooking->rate = $request->rate;

            $staffHouseBooking->additional_bedding = $request->bedding * 200;
            if($request->totalAmount == "FREE"){
                $staffHouseBooking->total_amount = 0;
            }else{
                $staffHouseBooking->total_amount = $request->totalAmount;
            }
            $staffHouseBooking->num_of_male = $request->numOfMale;
            $staffHouseBooking->num_of_female = $request->numOfFemale;
            $staffHouseBooking->total_lodgers = $request->numOfMale + $request->numOfFemale;
            $staffHouseBooking->male_guest = implode(',', array_values($maleGuestsArray));
            $staffHouseBooking->female_guest = implode(',', array_values($femaleGuestsArray));
            $staffHouseBooking->special_request = ucfirst($request->specialRequests);
            $staffHouseBooking->payment = $request->payment;
            $staffHouseBooking->save();
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Added a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            $facility = Facility::where('facility_name', 'Staff House')->first();
            $admin = Client::where('role', 'AdminSH')->first();
            if($admin){
                (new EmailController)->sendPreReservationNotification(
                    $admin->email,
                    $admin->fullname,
                    $staffHouseBooking->fullname,
                    $staffHouseBooking->SH_number,
                    $facility->facility_name,
                    $staffHouseBooking->room_number,
                    $staffHouseBooking->check_in_date,
                    $staffHouseBooking->arrival,
                    $staffHouseBooking->departure,
                    $staffHouseBooking->check_out_date);
            }
            return !is_null($staffHouseBooking) ? 1 : 0;
        }
    }
    private function generateSHNumber(){
        $currentYear = Carbon::now()->year;
        $latestGHNumber = StaffHouseBooking::whereYear('created_at', $currentYear)
                            ->orderBy('SH_number', 'desc')
                            ->pluck('SH_number')
                            ->first();
        if (!$latestGHNumber) {
            return $currentYear . '-001';
        }
        $numberPart = intval(substr($latestGHNumber, -3)) + 1;
        $paddedNumber = str_pad($numberPart, 3, '0', STR_PAD_LEFT);
        return $currentYear . '-' . $paddedNumber;
    }
    public function storeDftcBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $client_id = session()->get('loggedInCustomer')['id'];
            $dftcBooking = new DftcBooking();
            $dftcBooking->client_id = $client_id;
            $dftcBooking->room_id = $room->id;
            $dftcBooking->room_number = $request->room_number;
            $dftcBooking->DFTC_number = $this->generateDFTCNumber();
            $dftcBooking->DFTC_date = $formattedDateTime;
            $dftcBooking->fullname = $request->fullname;
            $dftcBooking->position = $request->position;
            $dftcBooking->agency = $request->agency;
            $dftcBooking->contact = $request->contactnumber;
            $dftcBooking->address = $request->address;
            $dftcBooking->room_number = $room->room_number;
            $dftcBooking->email = $request->email;
            $dftcBooking->activity = ucfirst($finalActivity);
            $dftcBooking->number_of_days = $request->numberOfDays;
            $dftcBooking->number_of_nights = $request->numberOfNights;
            $dftcBooking->check_in_date = $checkInDate;
            $dftcBooking->check_out_date = $checkOutDate;
            $dftcBooking->arrival = $arrival;
            $dftcBooking->status = "Pending Review";
            $dftcBooking->departure = $departure;
            $dftcBooking->rate = $request->rate;
            if($request->totalAmount == "FREE"){
                $dftcBooking->total_amount = 0.00;
            }else{
                $dftcBooking->total_amount = $request->totalAmount;
            }
            $dftcBooking->num_of_male = $request->numOfMale;
            $dftcBooking->num_of_female = $request->numOfFemale;
            $dftcBooking->total_lodgers = $request->numOfMale + $request->numOfFemale;
            $dftcBooking->special_request = ucfirst($request->specialRequests);
            $dftcBooking->save();
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Added a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            $facility = Facility::where('facility_name', 'DFTC')->first();
            $admin = Client::where('role', 'AdminDFTC')->first();
            if($admin){
                (new EmailController)->sendPreReservationNotification(
                    $admin->email,
                    $admin->fullname,
                    $dftcBooking->fullname,
                    $dftcBooking->DFTC_number,
                    $facility->facility_name,
                    $dftcBooking->room_number,
                    $dftcBooking->check_in_date,
                    $dftcBooking->arrival,
                    $dftcBooking->departure,
                    $dftcBooking->check_out_date);
            }
            return !is_null($dftcBooking) ? 1 : 0;
        }
    }
    public function storeDftcHallBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
            'janitorservices' => 'required',
            'avservices' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $client_id = session()->get('loggedInCustomer')['id'];
            $dftcBooking = new DftcBooking();
            $dftcBooking->client_id = $client_id;
            $dftcBooking->room_id = $room->id;
            $dftcBooking->room_number = $request->room_number;
            $dftcBooking->DFTC_number = $this->generateDFTCNumber();
            $dftcBooking->DFTC_date = $formattedDateTime;
            $dftcBooking->fullname = $request->fullname;
            $dftcBooking->position = $request->position;
            $dftcBooking->agency = $request->agency;
            $dftcBooking->contact = $request->contactnumber;
            $dftcBooking->address = $request->address;
            $dftcBooking->room_number = $room->room_number;
            $dftcBooking->email = $request->email;
            $dftcBooking->activity = ucfirst($finalActivity);
            $dftcBooking->number_of_days = $request->numberOfNights;
            $dftcBooking->number_of_nights = $request->numberOfDays;
            $dftcBooking->check_in_date = $checkInDate;
            $dftcBooking->check_out_date = $checkOutDate;
            $dftcBooking->arrival = $arrival;
            $dftcBooking->status = "Pending Review";
            $dftcBooking->departure = $departure;
            $dftcBooking->rate = $request->rate;
            if($request->totalAmount == "FREE"){
                $dftcBooking->total_amount = 0.00;
            }else{
                $dftcBooking->total_amount = $request->totalAmount;
            }
            $dftcBooking->num_of_male = $request->numOfMale;
            $dftcBooking->num_of_female = $request->numOfFemale;
            $dftcBooking->total_lodgers = $request->numOfMale + $request->numOfFemale;
            $dftcBooking->special_request = ucfirst($request->specialRequests);
            $dftcBooking->janitor_services = $request->janitorservices;
            $dftcBooking->av_services = $request->avservices;
            $dftcBooking->save();
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Added a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            $facility = Facility::where('facility_name', 'DFTC')->first();
            $admin = Client::where('role', 'AdminDFTC')->first();
            if($admin){
                (new EmailController)->sendPreReservationNotification(
                    $admin->email,
                    $admin->fullname,
                    $dftcBooking->fullname,
                    $dftcBooking->DFTC_number,
                    $facility->facility_name,
                    $dftcBooking->room_number,
                    $dftcBooking->check_in_date,
                    $dftcBooking->arrival,
                    $dftcBooking->departure,
                    $dftcBooking->check_out_date);
            }
            return !is_null($dftcBooking) ? 1 : 0;
        }
    }
    private function generateDFTCNumber(){
        $currentYear = Carbon::now()->year;
        $latestGHNumber = DftcBooking::whereYear('created_at', $currentYear)
                            ->orderBy('DFTC_number', 'desc')
                            ->pluck('DFTC_number')
                            ->first();
        if (!$latestGHNumber) {
            return $currentYear . '-001';
        }
        $numberPart = intval(substr($latestGHNumber, -3)) + 1;
        $paddedNumber = str_pad($numberPart, 3, '0', STR_PAD_LEFT);
        return $currentYear . '-' . $paddedNumber;
    }
    public function getGuestHousePreBookingDetailsClient(Request $request) {
        $roomId = $request->input('room_id');
        $bookings = GuestHouseBooking::where('room_id', $roomId)->where('status', 'Reviewed')->get();
        $currentDateTime = Carbon::now('Asia/Manila');
        $filteredBookings = $bookings->filter(function ($booking) use ($currentDateTime) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $currentDateTime->lte($checkOutDateTime);
        });
        if ($bookings->isNotEmpty()) {
            $bookingsArray = $filteredBookings->map(function ($booking) {
                return [
                    'GH_number' => $booking->GH_number,
                    'checkin_date' => $booking->check_in_date,
                    'checkout_date' => $booking->check_out_date,
                    'departure' => $booking->departure,
                ];
            });
            $GH_numbers = [];
            $checkin_dates = [];
            $checkout_dates = [];
            $departures = [];
            foreach ($bookingsArray as $booking) {
                $GH_numbers[] = $booking['GH_number'];
                $checkin_dates[] = $booking['checkin_date'];
                $checkout_dates[] = $booking['checkout_date'];
                $departures[] = $booking['departure'];
            }
            $response = [
                'bookingsArray' => $bookingsArray,
                'GH_numbers' => $GH_numbers,
                'checkin_dates' => $checkin_dates,
                'checkout_dates' => $checkout_dates,
                'departures' => $departures,
            ];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'No bookings found for this room'], 404);
        }
    }
    public function getStaffHousePreBookingDetailsClient(Request $request) {
        $roomId = $request->input('room_id');
        $bookings = StaffHouseBooking::where('room_id', $roomId)->where('status', 'Reviewed')->get();
        $currentDateTime = Carbon::now('Asia/Manila');
        $filteredBookings = $bookings->filter(function ($booking) use ($currentDateTime) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $currentDateTime->lte($checkOutDateTime);
        });
        if ($bookings->isNotEmpty()) {
            $bookingsArray = $filteredBookings->map(function ($booking) {
                return [
                    'SH_number' => $booking->SH_number,
                    'checkin_date' => $booking->check_in_date,
                    'checkout_date' => $booking->check_out_date,
                    'departure' => $booking->departure,
                ];
            });
            $SH_numbers = [];
            $checkin_dates = [];
            $checkout_dates = [];
            $departures = [];
            foreach ($bookingsArray as $booking) {
                $SH_numbers[] = $booking['SH_number'];
                $checkin_dates[] = $booking['checkin_date'];
                $checkout_dates[] = $booking['checkout_date'];
                $departures[] = $booking['departure'];
            }
            $response = [
                'bookingsArray' => $bookingsArray,
                'SH_numbers' => $SH_numbers,
                'checkin_dates' => $checkin_dates,
                'checkout_dates' => $checkout_dates,
                'departures' => $departures,
            ];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'No bookings found for this room'], 404);
        }
    }
    public function getDftcRoomPreBookingDetailsClient(Request $request) {
        $roomId = $request->input('room_id');
        $bookings = DftcBooking::where('room_id', $roomId)->where('status', 'Reviewed')->get();
        $currentDateTime = Carbon::now('Asia/Manila');
        $filteredBookings = $bookings->filter(function ($booking) use ($currentDateTime) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $currentDateTime->lte($checkOutDateTime);
        });
        if ($bookings->isNotEmpty()) {
            $bookingsArray = $filteredBookings->map(function ($booking) {
                return [
                    'DFTC_number' => $booking->DFTC_number,
                    'checkin_date' => $booking->check_in_date,
                    'checkout_date' => $booking->check_out_date,
                    'departure' => $booking->departure,
                ];
            });
            $DFTC_numbers = [];
            $checkin_dates = [];
            $checkout_dates = [];
            $departures = [];
            foreach ($bookingsArray as $booking) {
                $DFTC_numbers[] = $booking['DFTC_number'];
                $checkin_dates[] = $booking['checkin_date'];
                $checkout_dates[] = $booking['checkout_date'];
                $departures[] = $booking['departure'];
            }
            $response = [
                'bookingsArray' => $bookingsArray,
                'DFTC_numbers' => $DFTC_numbers,
                'checkin_dates' => $checkin_dates,
                'checkout_dates' => $checkout_dates,
                'departures' => $departures,
            ];
            return response()->json($response);
        } else {
            return response()->json(['error' => 'No bookings found for this room'], 404);
        }
    }
    public function storeEditGuestHouseBookingClient(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $maleGuestsArray = isset($request->maleGuests) && $request->maleGuests
            ? (is_array($request->maleGuests)
                ? array_map('trim', $request->maleGuests)
                : array_map('trim', explode(',', $request->maleGuests)))
            : []; // Default empty if null/empty

            // Process female guests safely - handle null & clean data
            $femaleGuestsArray = isset($request->femaleGuests) && $request->femaleGuests
            ? (is_array($request->femaleGuests)
                ? array_map('trim', $request->femaleGuests)
                : array_map('trim', explode(',', $request->femaleGuests)))
            : []; // Default empty if null/empty

            $maleGuestsArray = array_filter($maleGuestsArray, fn($val) => $val !== '');
            $femaleGuestsArray = array_filter($femaleGuestsArray, fn($val) => $val !== '');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $guestHouseBooking = GuestHouseBooking::where('id', $request->booking_id)->update([
                'room_id' => $room->id,
                'activity' => ucfirst($finalActivity),
                'number_of_days' => $request->numberOfDays,
                'number_of_nights' => $request->numberOfNights,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'arrival' => $arrival,
                'departure' => $departure,
                'rate' => $request->rate,
                'room_number' => $room->room_number,
                'total_amount' => $request->totalAmount == 'FREE' ? 0.00 : $request->totalAmount,
                'num_of_male' => $request->numOfMale,
                'num_of_female' => $request->numOfFemale,
                'total_lodgers' => $request->numOfMale + $request->numOfFemale,
                'videoke_rent'  => $request->rent,
                'additional_bedding' => $request->bedding * 100,
                'special_request' => $request->specialRequests,
                'male_guest' => implode(',', array_values($maleGuestsArray)),
                'female_guest' => implode(',', array_values($femaleGuestsArray))
            ]);
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Modified a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return !is_null($guestHouseBooking) ? 1 : 0;
        }
    }
    public function cancelGuestHouseBookingClient(Request $request){
        $bookingUpdated = GuestHouseBooking::where('id', $request->booking_id)->update([
            'status' => 'Canceled',
            'reason' => $request->reason,
        ]);
        if ($bookingUpdated) {
            $booking = GuestHouseBooking::find($request->booking_id);
            $admin = Client::where('role', 'AdminGH')->first();
            $facility = Facility::where('facility_name', 'Guest House')->first();

            if ($admin && $facility) {
                (new EmailController)->sendCanceledNotification(
                    $admin->email,
                    $admin->fullname,
                    $booking->fullname,
                    $booking->GH_number,
                    $facility->facility_name,
                    $booking->room_number,
                    'Canceled',
                    $request->reason
                );
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Canceled a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function storeEditStaffHouseBookingClient(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $maleGuestsArray = isset($request->maleGuests) && $request->maleGuests
            ? (is_array($request->maleGuests)
                ? array_map('trim', $request->maleGuests)
                : array_map('trim', explode(',', $request->maleGuests)))
            : []; // Default empty if null/empty

            // Process female guests safely - handle null & clean data
            $femaleGuestsArray = isset($request->femaleGuests) && $request->femaleGuests
            ? (is_array($request->femaleGuests)
                ? array_map('trim', $request->femaleGuests)
                : array_map('trim', explode(',', $request->femaleGuests)))
            : []; // Default empty if null/empty

            $maleGuestsArray = array_filter($maleGuestsArray, fn($val) => $val !== '');
            $femaleGuestsArray = array_filter($femaleGuestsArray, fn($val) => $val !== '');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $staffHouseBooking = StaffHouseBooking::find($request->booking_id);
            if ($staffHouseBooking) {
                $staffHouseBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($finalActivity),
                    'number_of_days' => $request->numberOfDays,
                    'number_of_nights' => $request->numberOfNights,
                    'check_in_date' => $checkInDate,
                    'check_out_date' => $checkOutDate,
                    'arrival' => $arrival,
                    'departure' => $departure,
                    'rate' => $request->rate,
                    'room_number' => $room->room_number,
                    'total_amount' => $request->totalAmount == 'FREE' ? 0.00 : $request->totalAmount,
                    'num_of_male' => $request->numOfMale,
                    'num_of_female' => $request->numOfFemale,
                    'total_lodgers' => $request->numOfMale + $request->numOfFemale,
                    'payment'  => $staffHouseBooking->position == 'Student' || $staffHouseBooking->position == 'Guest' ? $request->payment_hidden : $request->payment,
                    'additional_bedding' => $request->bedding * 100,
                    'special_request' => ucfirst($request->specialRequests),
                    'male_guest' => implode(',', array_values($maleGuestsArray)),
                    'female_guest' => implode(',', array_values($femaleGuestsArray))
                ]);
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Modified a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return !is_null($staffHouseBooking) ? 1 : 0;
        }
    }
    public function cancelStaffHouseBookingClient(Request $request){
        $bookingUpdated = StaffHouseBooking::where('id', $request->booking_id)->update([
            'status' => 'Canceled',
            'reason' => $request->reason,
        ]);
        if ($bookingUpdated) {
            $booking = StaffHouseBooking::find($request->booking_id);
            $admin = Client::where('role', 'AdminSH')->first();
            $facility = Facility::where('facility_name', 'Staff House')->first();

            if ($admin && $facility) {
                (new EmailController)->sendCanceledNotification(
                    $admin->email,
                    $admin->fullname,
                    $booking->fullname,
                    $booking->SH_number,
                    $facility->facility_name,
                    $booking->room_number,
                    'Canceled',
                    $request->reason
                );
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Canceled a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function storeEditDftcRoomBookingClient(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $dftcRoomBooking = DftcBooking::find($request->booking_id);
            if ($dftcRoomBooking) {
                $dftcRoomBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($finalActivity),
                    'number_of_days' => $request->numberOfDays,
                    'number_of_nights' => $request->numberOfNights,
                    'check_in_date' => $checkInDate,
                    'check_out_date' => $checkOutDate,
                    'arrival' => $arrival,
                    'departure' => $departure,
                    'rate' => $request->rate,
                    'room_number' => $room->room_number,
                    'total_amount' => $request->totalAmount == 'FREE' ? 0.00 : $request->totalAmount,
                    'num_of_male' => $request->numOfMale,
                    'num_of_female' => $request->numOfFemale,
                    'total_lodgers' => $request->numOfMale + $request->numOfFemale,
                    'special_request' => ucfirst($request->specialRequests),
                ]);
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Modified a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return !is_null($dftcRoomBooking) ? 1 : 0;
        }
    }
    public function storeEditDftcHallBookingClient(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:15',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activitySelected' => 'required|string|max:255',
            'customActivity' => 'nullable|string',
            'room_number' => 'required',
            'numberOfDays' => 'required',
            'numberOfNights' => 'required',
            'checkInDate' =>'required',
            'checkOutDate' =>'required',
            'arrival' => 'required',
            'departure' => 'required',
            'rate' => 'required',
            'totalAmount' => 'required',
            'numOfMale' => 'required|integer|min:0',
            'numOfFemale' => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $activity = $request->activitySelected;
            $customActivity = $request->customActivity;
            if ($activity === 'Others' && !empty($customActivity)) {
                $finalActivity = $customActivity;
            } else {
                $finalActivity = $activity;
            }
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $dftcHallBooking = DftcBooking::find($request->booking_id);
            if ($dftcHallBooking) {
                $dftcHallBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($finalActivity),
                    'number_of_days' => $request->numberOfNights,
                    'number_of_nights' => $request->numberOfDays,
                    'check_in_date' => $checkInDate,
                    'check_out_date' => $checkOutDate,
                    'arrival' => $arrival,
                    'departure' => $departure,
                    'rate' => $request->rate,
                    'room_number' => $room->room_number,
                    'total_amount' => $request->totalAmount == 'FREE' ? 0.00 : $request->totalAmount,
                    'num_of_male' => $request->numOfMale,
                    'num_of_female' => $request->numOfFemale,
                    'total_lodgers' => $request->numOfMale + $request->numOfFemale,
                    'special_request' => ucfirst($request->specialRequests),
                    'av_services' => $request->avservices,
                    'janitor_services' => $request->janitorservices
                ]);
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Modified a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return !is_null($dftcHallBooking) ? 1 : 0;
        }
    }
    public function cancelDftcBookingClient(Request $request){
        $bookingUpdated = DftcBooking::where('id', $request->booking_id)->update([
            'status' => 'Canceled',
            'reason' => $request->reason,
        ]);
        if ($bookingUpdated) {
            $booking = DftcBooking::find($request->booking_id);
            $admin = Client::where('role', 'AdminDFTC')->first();
            $facility = Facility::where('facility_name', 'DFTC')->first();

            if ($admin && $facility) {
                (new EmailController)->sendCanceledNotification(
                    $admin->email,
                    $admin->fullname,
                    $booking->fullname,
                    $booking->DFTC_number,
                    $facility->facility_name,
                    $booking->room_number,
                    'Canceled',
                    $request->reason
                );
            }
            $client_id = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Canceled a DFTC pre-reservation in into the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
}
