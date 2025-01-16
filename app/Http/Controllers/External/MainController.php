<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
class MainController extends Controller
{
    public function index(){
        if(session()->has('loggedInCustomer')){
            return back();
        }else if(session()->has('loggedInAdminGH')){
            return back();
        }else if(session()->has('loggedInSuperAdmin')){
            return back();
        }else if(session()->has('loggedInAdminDftc')){
            return back();
        }else if(session()->has('loggedInAdminSH')){
            return back();
        }else{
            return view('index');
        }
    }
    public function home(){
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];

        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.home');
    }
    public function bookingGuestHouse(){
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];

        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.preBookings.guestHouseBook');
    }
    public function bookingStaffHouse(){
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];

        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.preBookings.staffHouseBook');
    }
    public function bookingDFTC(){
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];

        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.preBookings.dftcBook');
    }
    public function bookingDFTCHall(){
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];

        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.preBookings.dftcHall');
    }
    public function guestHouseRooms(){
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

        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];
        foreach ($guestHouseRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function staffHouseRooms(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
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

        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];
        foreach ($staffHouseRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.rooms.staffHouseRooms' , ['staffHouseRooms' => $staffHouseRooms , 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function dftcRooms(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $DFTCrooms = Room::where('facility_id', $facilityId)->get();
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
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];
        foreach ($DFTCrooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.rooms.dftcRooms', ['DFTCrooms' => $DFTCrooms, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function dftcHalls(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $DFTChalls = Room::where('facility_id', $facilityId)->get();
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
        $sessions = [
            'loggedInCustomer',
            'loggedInAdminGH',
            'loggedInSuperAdmin',
            'loggedInAdminDftc',
            'loggedInAdminSH',
        ];
        foreach ($DFTChalls as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        foreach ($sessions as $session) {
            if (session()->has($session)) {
                return back();
            }
        }
        return view('main.rooms.dftcHalls', ['DFTChalls' => $DFTChalls, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function getGuestHousePreBookingDetailsMain(Request $request) {
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
    public function getStaffHousePreBookingDetailsMain(Request $request) {
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
    public function getDftcRoomPreBookingDetailsMain(Request $request) {
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
