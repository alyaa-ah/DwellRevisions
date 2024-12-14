<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\GuestHouseBooking;
use App\Rules\GuestsRequired;
use App\Rules\GuestsRequireFemale;
use App\Models\StaffHouseBooking;
use App\Models\Room;
use App\Models\DftcBooking;
use App\Models\Client;
use App\Models\Facility;
use App\Http\Controllers\Audit\AuditController;
use App\Http\Controllers\Email\EmailController;
class SuperAdminBookingController extends Controller
{
    public function storeGuestHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            'maleGuests' => [new GuestsRequired($request->numOfMale, $request->numOfMale)],
            'femaleGuests' => [new GuestsRequireFemale($request->numOfFemale, $request->numOfFemale)],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $client_id = session()->get('loggedInSuperAdmin')['id'];
            $guestHouseBooking = new GuestHouseBooking();
            $guestHouseBooking->client_id = $client_id;
            $guestHouseBooking->room_id = $room->id;
            $guestHouseBooking->room_number = $room->room_number;
            $guestHouseBooking->GH_number = $this->generateGHNumber();
            $guestHouseBooking->GH_date = $formattedDateTime;
            $guestHouseBooking->fullname = ucwords($request->fullname);
            $guestHouseBooking->position = $request->position;
            $guestHouseBooking->agency = ucwords($request->agency);
            $guestHouseBooking->contact = $request->contactnumber;
            $guestHouseBooking->address = ucwords($request->address);
            $guestHouseBooking->email = $request->email;
            $guestHouseBooking->activity = ucfirst($request->activity);
            $guestHouseBooking->number_of_days = $request->numberOfDays;
            $guestHouseBooking->number_of_nights = $request->numberOfNights;
            $guestHouseBooking->check_in_date = $checkInDate;
            $guestHouseBooking->check_out_date = $checkOutDate;
            $guestHouseBooking->arrival = $arrival;
            $guestHouseBooking->status = "Reviewed";
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
            $guestHouseBooking->male_guest = ucwords($request->maleGuests);
            $guestHouseBooking->female_guest = ucwords($request->femaleGuests);
            $guestHouseBooking->special_request = ucfirst($request->specialRequests);
            $guestHouseBooking->save();
            $facility = Facility::where('facility_name', 'Guest House')->first();
            $admin = Client::where('role', 'AdminGH')->first();
            if($admin){
                (new EmailController)->superAdminNotification(
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Added a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
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
    public function storeStaffHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            'maleGuests' => [new GuestsRequired($request->numOfMale)],
            'femaleGuests' => [new GuestsRequireFemale($request->numOfFemale)],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_numberStaffHouse);
            $client_id = session()->get('loggedInSuperAdmin')['id'];
            $staffHouseBooking = new StaffHouseBooking();
            $staffHouseBooking->client_id = $client_id;
            $staffHouseBooking->room_id = $room->id;
            $staffHouseBooking->room_number = $request->room_number;
            $staffHouseBooking->SH_number = $this->generateSHNumber();
            $staffHouseBooking->SH_date = $formattedDateTime;
            $staffHouseBooking->fullname = ucwords($request->fullname);
            $staffHouseBooking->position = $request->position;
            $staffHouseBooking->agency = ucwords($request->agency);
            $staffHouseBooking->contact = $request->contactnumber;
            $staffHouseBooking->address = ucwords($request->address);
            $staffHouseBooking->room_number = $room->room_number;
            $staffHouseBooking->email = $request->email;
            $staffHouseBooking->activity = ucfirst($request->activity);
            $staffHouseBooking->number_of_days = $request->numberOfDays;
            $staffHouseBooking->number_of_nights = $request->numberOfNights;
            $staffHouseBooking->check_in_date = $checkInDate;
            $staffHouseBooking->check_out_date = $checkOutDate;
            $staffHouseBooking->arrival = $arrival;
            $staffHouseBooking->status = "Reviewed";
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
            $staffHouseBooking->male_guest = ucwords($request->maleGuests);
            $staffHouseBooking->female_guest = ucwords($request->femaleGuests);
            $staffHouseBooking->special_request = ucfirst($request->specialRequests);
            $staffHouseBooking->payment = $request->payment;
            $staffHouseBooking->save();
            $facility = Facility::where('facility_name', 'Staff House')->first();
            $admin = Client::where('role', 'AdminSH')->first();
            if($admin) {
                (new EmailController)->superAdminNotification(
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Added a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($staffHouseBooking) ? 1 : 0;
        }
    }
    public function storeDftcBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $client_id = session()->get('loggedInSuperAdmin')['id'];
            $dftcBooking = new DftcBooking();
            $dftcBooking->client_id = $client_id;
            $dftcBooking->room_id = $room->id;
            $dftcBooking->room_number = $request->room_number;
            $dftcBooking->DFTC_number = $this->generateDFTCNumber();
            $dftcBooking->DFTC_date = $formattedDateTime;
            $dftcBooking->fullname = ucwords($request->fullname);
            $dftcBooking->position = $request->position;
            $dftcBooking->agency = ucwords($request->agency);
            $dftcBooking->contact = $request->contactnumber;
            $dftcBooking->address = ucwords($request->address);
            $dftcBooking->room_number = $room->room_number;
            $dftcBooking->email = $request->email;
            $dftcBooking->activity = ucfirst($request->activity);
            $dftcBooking->number_of_days = $request->numberOfDays;
            $dftcBooking->number_of_nights = $request->numberOfNights;
            $dftcBooking->check_in_date = $checkInDate;
            $dftcBooking->check_out_date = $checkOutDate;
            $dftcBooking->arrival = $arrival;
            $dftcBooking->status = "Reviewed"; //
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
            $facility = Facility::where('facility_name', 'DFTC')->first();
            $admin = Client::where('role', 'AdminDFTC')->first();
            if($admin){
                (new EmailController)->superAdminNotification(
                    $admin->email,
                    $admin->fullname,
                    $dftcBooking->fullname,
                    $dftcBooking->SH_number,
                    $facility->facility_name,
                    $dftcBooking->room_number,
                    $dftcBooking->check_in_date,
                    $dftcBooking->arrival,
                    $dftcBooking->departure,
                    $dftcBooking->check_out_date);
            }
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Added a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($dftcBooking) ? 1 : 0;
        }
    }
    public function storeDftcHallBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            $formattedDateTime = Carbon::now('Asia/Manila')->format('F j, Y h:i A');
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $client_id = session()->get('loggedInSuperAdmin')['id'];
            $dftcBooking = new DftcBooking();
            $dftcBooking->client_id = $client_id;
            $dftcBooking->room_id = $room->id;
            $dftcBooking->room_number = $request->room_number;
            $dftcBooking->DFTC_number = $this->generateDFTCNumber();
            $dftcBooking->DFTC_date = $formattedDateTime;
            $dftcBooking->fullname = ucwords($request->fullname);
            $dftcBooking->position = $request->position;
            $dftcBooking->agency = ucwords($request->agency);
            $dftcBooking->contact = $request->contactnumber;
            $dftcBooking->address = ucwords($request->address);
            $dftcBooking->room_number = $room->room_number;
            $dftcBooking->email = $request->email;
            $dftcBooking->activity = ucfirst($request->activity);
            $dftcBooking->number_of_days = $request->numberOfDays;
            $dftcBooking->number_of_nights = $request->numberOfNights;
            $dftcBooking->check_in_date = $checkInDate;
            $dftcBooking->check_out_date = $checkOutDate;
            $dftcBooking->arrival = $arrival;
            $dftcBooking->status = "Reviewed    ";
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
            $facility = Facility::where('facility_name', 'DFTC')->first();
            $admin = Client::where('role', 'AdminDFTC')->first();
            if($admin) {
                (new EmailController)->superAdminNotification(
                    $admin->email,
                    $admin->fullname,
                    $dftcBooking->fullname,
                    $dftcBooking->SH_number,
                    $facility->facility_name,
                    $dftcBooking->room_number,
                    $dftcBooking->check_in_date,
                    $dftcBooking->arrival,
                    $dftcBooking->departure,
                    $dftcBooking->check_out_date);
            }
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Added a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
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
    public function storeEditGuestHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            'maleGuests' => [new GuestsRequired($request->numOfMale, $request->numOfMale)],
            'femaleGuests' => [new GuestsRequired($request->numOfFemale, $request->numOfFemale)],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
        ]);
        }else{
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $guestHouseBooking = GuestHouseBooking::where('id', $request->booking_id)->update([
                'room_id' => $room->id,
                'activity' => ucfirst($request->activity),
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
                'male_guest' => ucwords($request->maleGuests),
                'female_guest' => ucwords($request->femaleGuests)
            ]);
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Modified a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($guestHouseBooking) ? 1 : 0;
        }
    }
    public function deleteGuestHouseBooking(Request $request){
        $guestHouseBooking = GuestHouseBooking::where('id', $request->booking_id)->delete();
        return !is_null($guestHouseBooking) ? 1 : 0;
    }
    public function cancelGuestHouseBooking(Request $request){
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Canceled a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function cancelStaffHouseBooking(Request $request){
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Canceled a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function cancelDftcBooking(Request $request){
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Canceled a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function storeEditStaffHouseBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            'maleGuests' => [new GuestsRequired($request->numOfMale, $request->numOfMale)],
            'femaleGuests' => [new GuestsRequired($request->numOfFemale, $request->numOfFemale)],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }else{
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $staffHouseBooking = StaffHouseBooking::find($request->booking_id);
            if ($staffHouseBooking) {
                $staffHouseBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($request->activity),
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
                    'male_guest' => ucwords($request->maleGuests),
                    'female_guest' => ucwords($request->femaleGuests)
                ]);
            }
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Modified a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($staffHouseBooking) ? 1 : 0;
        }
    }
    public function deleteStaffHouseBooking(Request $request){
        $staffHouseBooking = StaffHouseBooking::where('id', $request->booking_id)->delete();
        return !is_null($staffHouseBooking) ? 1 : 0;
    }
    public function storeEditDftcRoomBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $dftcRoomBooking = DftcBooking::find($request->booking_id);
            if ($dftcRoomBooking) {
                $dftcRoomBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($request->activity),
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Modified a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($dftcRoomBooking) ? 1 : 0;
        }
    }
    public function deleteDftcBooking(Request $request){
        $dftcBooking = DftcBooking::where('id', $request->booking_id)->delete();
        return !is_null($dftcBooking) ? 1 : 0;
    }
    public function storeEditDftcHallBooking(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:100',
            'position' => 'required',
            'agency' => 'required',
            'contactnumber' => 'required|min:9|max:13',
            'address' => 'required|min:6|max:100',
            'email' => 'required',
            'activity' => 'required|min:6|max:255',
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
            $arrival = Carbon::createFromFormat('H:i', $request->arrival)->format('h:i A');
            $departure = Carbon::createFromFormat('H:i', $request->departure)->format('h:i A');
            $checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->checkOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
            $room = Room::find($request->room_number);
            $dftcHallBooking = DftcBooking::find($request->booking_id);
            if ($dftcHallBooking) {
                $dftcHallBooking->update([
                    'room_id' => $room->id,
                    'activity' => ucfirst($request->activity),
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
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Modified a DFTC pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($dftcHallBooking) ? 1 : 0;
        }
    }
    public function getGuestHousePreBookingDetails(Request $request) {
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
    public function getStaffHousePreBookingDetails(Request $request) {
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
    public function getDftcRoomPreBookingDetails(Request $request) {
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
}
