<?php

namespace App\Http\Controllers\AdminDFTC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
class AdminDFTCMainController extends Controller
{
    public function index(){
        return view('adminDftc.index');
    }
    public function goToHome(){
        return view('adminDftc.home');
    }
    public function goToGuestHouseRoomsAdminDftc(){
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
        return view('adminDftc.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms , 'bookings' => $bookings]);
    }
    public function goToStaffHouseRoomsAdminDftc(){
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
        return view('adminDftc.rooms.staffHouseRooms', ['staffHouseRooms' => $staffHouseRooms , 'bookings' => $bookings]);
    }
    public function goToDftcRoomsAdminDftc(){
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
        return view('adminDftc.rooms.dftcRooms', ['dftcRooms' => $dftcRooms , 'bookings' => $bookings]);
    }
    public function goToDftcHallsAdminDftc(){
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
        return view('adminDftc.rooms.dftcHalls', ['dftcHalls' => $dftcHalls , 'bookings' => $bookings]);
    }
    public function goToGuestHousePreBookingAdminDftc(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminDftc.preBookings.guestHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToStaffHousePreBookingAdminDftc(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminDftc.preBookings.staffHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcRoomPreBookingAdminDftc(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminDftc.preBookings.dftcBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcHallPreBookingAdminDftc(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminDftc.preBookings.dftcHall', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function getRoomDataGuestHouseAdminDftc(Request $request) {
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
    public function getRoomDataStaffHouseAdminDftc(Request $request) {
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
    public function getRoomDataDftcRoomAdminDftc(Request $request) {
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
    public function getRoomDataDftcHallAdminDftc(Request $request) {
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
    public function getRoomGuestHouseEditAdminDftc(Request $request) {
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
    public function getRoomStaffHouseEditAdminDftc(Request $request) {
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
    public function getRoomDftcRoomEditAdminDftc(Request $request) {
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
    public function getRoomDftcHallEditAdminDftc(Request $request) {
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
    public function logoutAdminDftc(){
        if(session()->has('loggedInAdminDftc')){
            session()->pull('loggedInAdminDftc');
            return redirect('/');
        }
    }
}
