<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
class SuperAdminMainController extends Controller
{
    public function index(){
        return view('superAdmin.index');
    }
    public function goToHome(){
        return view('superAdmin.home');
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
        return view('superAdmin.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms , 'bookings' => $bookings]);
    }
    public function goToStaffHouseRooms(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $staffHouse = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('superAdmin.rooms.staffHouseRooms', ['staffHouse' => $staffHouse, 'bookings' => $bookings]);
    }
    public function goToDftcRooms(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $DFTC = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('superAdmin.rooms.dftcRooms', ['DFTC' => $DFTC, 'bookings' => $bookings]);
    }
    public function goToDftcHalls(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $DFTC = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            });
        return view('superAdmin.rooms.dftcHalls', ['DFTC' => $DFTC, 'bookings' => $bookings]);
    }
    public function goToDftcPreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('superAdmin.preBookings.dftcBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcPreBookingHall(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('superAdmin.preBookings.dftcHallBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToStaffHousePreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('superAdmin.preBookings.staffHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToGuestHousePreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('superAdmin.preBookings.guestHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function getRoomData1(Request $request) {
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
    public function getRoomDataStaffHouseBook1(Request $request) {
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
    public function getRoomDataDftcBook1(Request $request) {
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
    public function getRoomDataDftcHallBook1(Request $request) {
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
}
