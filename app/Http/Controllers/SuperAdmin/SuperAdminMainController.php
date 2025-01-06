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
        return view('superAdmin.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms , 'bookings' => $bookings , 'feedbacks' => $feedbacks]);
    }
    public function goToStaffHouseRooms(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $staffHouse = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $staffHouseRooms = Room::where('facility_id', $facilityId)->get();
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
        return view('superAdmin.rooms.staffHouseRooms', ['staffHouse' => $staffHouse, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcRooms(){
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
        return view('superAdmin.rooms.dftcRooms', ['dftcRooms' => $dftcRooms, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcHalls(){
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
        return view('superAdmin.rooms.dftcHalls', ['dftcHalls' => $dftcHalls, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
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
