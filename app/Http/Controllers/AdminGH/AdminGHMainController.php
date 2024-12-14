<?php

namespace App\Http\Controllers\AdminGH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
use App\Http\Controllers\Audit\AuditController;
class AdminGHMainController extends Controller
{
    public function index(){
        return view('adminGH.index');
    }
    public function goToHome(){
        return view('adminGH.home');
    }
    public function goToGuestHouseRooms(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $guestHouseRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('adminGH.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms , 'bookings' => $bookings]);
    }
    public function goToStaffHouseRooms(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $staffHouseRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('adminGH.rooms.staffHouseRooms', ['staffHouseRooms' => $staffHouseRooms , 'bookings' => $bookings]);
    }
    public function goToDftcRooms(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $dftcRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('adminGH.rooms.dftcRooms', ['dftcRooms' => $dftcRooms , 'bookings' => $bookings]);
    }
    public function goToDftcHalls(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $dftcHalls = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('adminGH.rooms.dftcHalls', ['dftcHalls' => $dftcHalls , 'bookings' => $bookings]);
    }
    public function goToGuestHousePreBookingAdminGH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminGH.preBookings.guestHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToStaffHousePreBookingAdminGH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminGH.preBookings.staffHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcRoomPreBookingAdminGH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminGH.preBookings.dftcBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcHallPreBookingAdminGH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminGH.preBookings.dftcHall', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function getRoomDataGuestHouseAdminGH(Request $request) {
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
    public function getRoomDataStaffHouseAdminGH(Request $request) {
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
    public function getRoomDataDftcRoomAdminGH(Request $request) {
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
    public function getRoomDataDftcHallAdminGH(Request $request) {
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
    public function getRoomGuestHouseEditAdminGH(Request $request) {
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
    public function getRoomStaffHouseEditAdminGH(Request $request) {
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
    public function getRoomDftcRoomEditAdminGH(Request $request) {
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
    public function getRoomDftcHallEditAdminGH(Request $request) {
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
    public function logoutAdminGH(){
        if(session()->has('loggedInAdminGH')){
            $clientId = session()->get('loggedInAdminGH')['id'];
            $fullname = session()->get('loggedInAdminGH')['fullname'];
            $role = session()->get('loggedInAdminGH')['role'];
            $activity = "Logged out in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            session()->pull('loggedInAdminGH');
            return redirect('/');
        }
    }
}
