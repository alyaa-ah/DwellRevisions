<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Facility;
use App\Models\Room;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Audit\AuditController;
class ClientFunctionController extends Controller
{
    public function index(){
        return view('client.index');
    }
    public function goToGuestHouseReservation(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where(function($query) {
            $query->where('status', 'Reviewed')
                  ->orWhere('status', 'Pending Review');
            })
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })->map(function ($booking) use ($now) {
            $checkInDate = Carbon::createFromFormat('F j, Y', $booking->check_in_date, 'Asia/Manila');
            $arrivalTime = Carbon::createFromFormat('h:i A', $booking->arrival, 'Asia/Manila');
            $checkInDateTime = $checkInDate->setTimeFrom($arrivalTime);
            $threeDaysBeforeCheckIn = $checkInDateTime->copy()->subDays(3);
            $booking->canCancel = $now->lte($threeDaysBeforeCheckIn);
            return $booking;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('client.functions.guesthouse.view-bookings' , ['bookings' => $bookings, 'countBookings' => $countBookings, 'rooms' => $rooms]);
    }
    public function goToStaffHouseReservation(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where(function($query) {
            $query->where('status', 'Reviewed')
                  ->orWhere('status', 'Pending Review');
            })
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })->map(function ($booking) use ($now) {
            $checkInDate = Carbon::createFromFormat('F j, Y', $booking->check_in_date, 'Asia/Manila');
            $arrivalTime = Carbon::createFromFormat('h:i A', $booking->arrival, 'Asia/Manila');
            $checkInDateTime = $checkInDate->setTimeFrom($arrivalTime);
            $threeDaysBeforeCheckIn = $checkInDateTime->copy()->subDays(3);
            $booking->canCancel = $now->lte($threeDaysBeforeCheckIn);
            return $booking;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('client.functions.staffhouse.view-bookings' , ['bookings' => $bookings, 'countBookings' => $countBookings, 'rooms' => $rooms]);
    }
    public function goToDftcReservation(){
        $client_id = session()->get('loggedInCustomer')['id'];
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get()->keyBy('id');
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where(function($query) {
            $query->where('status', 'Reviewed')
                  ->orWhere('status', 'Pending Review');
        })
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })
        ->map(function ($booking) use ($rooms, $now) {
            if (isset($rooms[$booking->room_id])) {
                $booking->room_type = $rooms[$booking->room_id]->room_type;
            } else {
                $booking->room_type = null;
            }
            $checkInDate = Carbon::createFromFormat('F j, Y', $booking->check_in_date, 'Asia/Manila');
            $arrivalTime = Carbon::createFromFormat('h:i A', $booking->arrival, 'Asia/Manila');
            $checkInDateTime = $checkInDate->setTimeFrom($arrivalTime);
            $threeDaysBeforeCheckIn = $checkInDateTime->copy()->subDays(3);
            $booking->canCancel = $now->lte($threeDaysBeforeCheckIn);
            return $booking;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('client.functions.dftc.view-bookings' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToGuestHouseHistoryClient(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $countBookings = count($bookings);
        return view('client.functions.guesthouse.view-history' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToStaffHouseHistoryClient(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $countBookings = count($bookings);
        return view('client.functions.staffhouse.view-history' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToDftcHistoryClient(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $countBookings = count($bookings);
        return view('client.functions.dftc.view-history' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToGuestHouseCanceledBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = GuestHouseBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.guesthouse.view-canceled' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToGuestHouseRejectedBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = GuestHouseBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.guesthouse.view-rejected' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToStaffHouseCanceledBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = StaffHouseBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.staffhouse.view-canceled' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToStaffHouseRejectedBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = StaffHouseBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.staffhouse.view-rejected' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToDftcCanceledBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = DftcBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.dftc.view-canceled' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToDftcRejectedBookings(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInCustomer')['id'];
        $bookings = DftcBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('client.functions.dftc.view-rejected' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToViewAccount(){
        $client_id = session()->get('loggedInCustomer')['id'];
        $clients = Client::where('id', $client_id)->get();
        return view('client.functions.account.view-account', ['clients' => $clients]);
    }
    public function editAccountClient(Request $request){
        $client_id = session()->get('loggedInCustomer')['id'];
        $client = Client::where('id', $client_id)->first();
        $validator = Validator::make($request->all(), [
            'fullname' =>'required|max:100',
            'agency' =>'required|max:50',
            'address' =>'required|max:100',
            'position' =>'required',
            'contact' =>'required|min:9|max:13',
            'old_password' =>'required',
        ]);
        if ($request->filled('username') && $request->username !== $client->username) {
            $validator->addRules([
                'username' => 'required|min:8|max:30|unique:clients,username',
            ]);
        }
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()
            ]);
        } else {
            if (!Hash::check($request->input('old_password'), $client->password)) {
               return 2;
            } else {
                $updateData = [
                    'fullname' => $request->fullname,
                    'agency' => $request->agency,
                    'address' => $request->address,
                    'position' => $request->position,
                    'contact' => $request->contact,
                    'username' => $request->username,
                ];
                if ($request->filled('new_password')) {
                    $passwordValidator = Validator::make($request->all(), [
                        'new_password' => 'required|min:8|max:50',
                        're_password' => 'required|min:8|same:new_password',
                    ], [
                        're_password.same' => 'Retype password does not match',
                        're_password.required' => 'Retype password is required',
                    ]);
                    if ($passwordValidator->fails()) {
                        return response()->json([
                            'message' => $passwordValidator->getMessageBag()
                        ]);
                    }
                    $updateData['password'] = Hash::make($request->input('new_password'));
                }
                $client->update($updateData);
                $fullname = session()->get('loggedInCustomer')['fullname'];
                $role = session()->get('loggedInCustomer')['role'];
                $activity = "Modified own account in the system.";
                (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                return !is_null($client) ? 1 : 0;
            }
        }
    }
    public function deactivateAccount(Request $request){
        $client = Client::where('id', $request->client_id)->update([
            'status' => 'Inactive',
        ]);
        $client_id = session()->get('loggedInCustomer')['id'];
        $fullname = session()->get('loggedInCustomer')['fullname'];
        $role = session()->get('loggedInCustomer')['role'];
        $activity = "Deactivate own account in the system.";
        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
        return!is_null($client)? 1 : 0;
    }
    public function activateAccount(Request $request){
        $client = Client::where('id', $request->client_id)->update([
            'status' => 'Active',
        ]);
        $client_id = session()->get('loggedInCustomer')['id'];
        $fullname = session()->get('loggedInCustomer')['fullname'];
        $role = session()->get('loggedInCustomer')['role'];
        $activity = "Activated own account in the system.";
        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
        return!is_null($client)? 1 : 0;
    }
    public function getRoomDataEditGuestHouseClient(Request $request) {
        $id = $request->input('room_number');
        $room = Room::find($id);

        if ($room) {
            return response()->json([
                'room_rate' => $room->room_rate,
                'room_capacity' => $room->room_capacity
            ]);
        } else {
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
    public function getRoomDataEditDftcClient(Request $request) {
        $id = $request->input('room_number');
        $room = Room::find($id);

        if ($room) {
            return response()->json([
                'room_rate' => $room->room_rate,
                'room_capacity' => $room->room_capacity
            ]);
        } else {
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
    public function getRoomDataEditDftcHallClient(Request $request) {
        $id = $request->input('room_number');
        $room = Room::find($id);

        if ($room) {
            return response()->json([
                'room_rate' => $room->room_rate,
                'room_capacity' => $room->room_capacity
            ]);
        } else {
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
    public function getRoomDataEditStaffHouseClient(Request $request) {
        $id = $request->input('room_number');
        $room = Room::find($id);

        if ($room) {
            return response()->json([
                'room_rate' => $room->room_rate,
                'room_capacity' => $room->room_capacity
            ]);
        } else {
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
    public function logoutCustomer(){
        if(session()->has('loggedInCustomer')){
            $clientId = session()->get('loggedInCustomer')['id'];
            $fullname = session()->get('loggedInCustomer')['fullname'];
            $role = session()->get('loggedInCustomer')['role'];
            $activity = "Logged out into the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            session()->pull('loggedInCustomer');
            return redirect('/');
        }
    }
}
