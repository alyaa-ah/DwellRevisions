<?php

namespace App\Http\Controllers\AdminSH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
use App\Http\Controllers\Audit\AuditController;
class AdminSHMainController extends Controller
{
    public function index(){
        return view('adminSH.index');
    }
    public function goToHome(){
        return view('adminSH.home');
    }
    public function goToGuestHouseRoomsAdminSH(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $guestHouseRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->lte($checkOutDateTime);
                }
            } catch (\Exception $e) {

                return false;
            }
            return false;
        });
        $feedbacks = GuestHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->gte($checkOutDateTime);
                }
            } catch (\Exception $e) {
                return false;
            }
            return false;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::parse($booking->comment_date, 'Asia/Manila');
        })
        ->map(function ($booking) {
            $booking->comment_date = Carbon::parse($booking->comment_date, 'Asia/Manila')->format('F j, Y');
            return $booking;
        });
        foreach ($guestHouseRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        return view('adminSH.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms , 'bookings' => $bookings , 'feedbacks' => $feedbacks]);
    }
    public function goToStaffHouseRoomsAdminSH(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $staffHouseRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $staffHouseRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->lte($checkOutDateTime);
                }
            } catch (\Exception $e) {

                return false;
            }
            return false;
        });
        $feedbacks = StaffHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->gte($checkOutDateTime);
                }
            } catch (\Exception $e) {
                return false;
            }
            return false;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::parse($booking->comment_date, 'Asia/Manila');
        })
        ->map(function ($booking) {
            $booking->comment_date = Carbon::parse($booking->comment_date, 'Asia/Manila')->format('F j, Y');
            return $booking;
        });
        foreach ($staffHouseRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        return view('adminSH.rooms.staffHouseRooms', ['staffHouseRooms' => $staffHouseRooms , 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcRoomsAdminSH(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $dftcRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->lte($checkOutDateTime);
                }
            } catch (\Exception $e) {

                return false;
            }
            return false;
        });
        $feedbacks = DftcBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->gte($checkOutDateTime);
                }
            } catch (\Exception $e) {
                return false;
            }
            return false;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::parse($booking->comment_date, 'Asia/Manila');
        })
        ->map(function ($booking) {
            $booking->comment_date = Carbon::parse($booking->comment_date, 'Asia/Manila')->format('F j, Y');
            return $booking;
        });
        foreach ($dftcRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        return view('adminSH.rooms.dftcRooms', ['dftcRooms' => $dftcRooms , 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcHallsAdminSH(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $dftcHalls = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->lte($checkOutDateTime);
                }
            } catch (\Exception $e) {

                return false;
            }
            return false;
        });
        $feedbacks = DftcBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                if ($checkOutDate && $departureTime) {
                    $checkOutDateTime = $checkOutDate->setTime($departureTime->hour, $departureTime->minute);
                    return $now->gte($checkOutDateTime);
                }
            } catch (\Exception $e) {
                return false;
            }
            return false;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::parse($booking->comment_date, 'Asia/Manila');
        })
        ->map(function ($booking) {
            $booking->comment_date = Carbon::parse($booking->comment_date, 'Asia/Manila')->format('F j, Y');
            return $booking;
        });
        foreach ($dftcHalls as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        return view('adminSH.rooms.dftcHalls', ['dftcHalls' => $dftcHalls , 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToGuestHousePreBookingAdminSH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminSH.preBookings.guestHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToStaffHousePreBookingAdminSH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminSH.preBookings.staffHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcRoomPreBookingAdminSH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminSH.preBookings.dftcBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcHallPreBookingAdminSH(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('adminSH.preBookings.dftcHall', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function getRoomDataGuestHouseAdminSH(Request $request) {
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
    public function getRoomDataStaffHouseAdminSH(Request $request) {
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
    public function getRoomDataDftcRoomAdminSH(Request $request) {
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
    public function getRoomDataDftcHallAdminSH(Request $request) {
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
        public function getRoomGuestHouseEditAdminSH(Request $request) {
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
    public function getRoomStaffHouseEditAdminSH(Request $request) {
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
    public function getRoomDftcRoomEditAdminSH(Request $request) {
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
    public function getRoomDftcHallEditAdminSH(Request $request) {
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
    public function logoutAdminSH(){
        if(session()->has('loggedInAdminSH')){
            $clientId = session()->get('loggedInAdminSH')['id'];
            $fullname = session()->get('loggedInAdminSH')['fullname'];
            $role = session()->get('loggedInAdminSH')['role'];
            $activity = "Logout into the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            session()->pull('loggedInAdminSH');
            return redirect('/');
        }
    }
}
