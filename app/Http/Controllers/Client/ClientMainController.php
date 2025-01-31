<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use Illuminate\Support\Carbon;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
class ClientMainController extends Controller
{
    public function goToHome(){
        return view('client.home');
    }
    public function goToDashboard(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInCustomer')['id'];
        $guestHouseBookings = GuestHouseBooking::
        where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        })
        ->map(function ($item) {
            $item->type = 'Guest House';
            return $item;
        });
        $staffHouseBookings = StaffHouseBooking::
            where('client_id', $client_id)
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
            })
            ->sortByDesc(function ($booking) {
                return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
            })
            ->map(function ($item) {
                $item->type = 'Staff House';
                return $item;
            });

            $dftcBookings = DftcBooking::
                where('client_id', $client_id)
                ->get()
                ->filter(function ($booking) use ($now) {
                    $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                    $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                    $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                    return $now->lte($checkOutDateTime);
                })
                ->sortByDesc(function ($booking) {
                    return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
                })
                ->map(function ($item) {
                    $item->type = 'DFTC';
                    return $item;
                });

                $allBookings = $guestHouseBookings
                ->concat($staffHouseBookings)
                ->concat($dftcBookings);
        return view('client.dashboard.dashboard', compact('allBookings'));
    }
    public function goToRatingsGuestHouse(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInCustomer')['id'];
        $guestHouseCurrentBookingsHistory = GuestHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            } catch (\Exception $e) {
                return false;
            }
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        return view('client.ratings.guesthouse', [
            'guestHouseCurrentBookingsHistory' => $guestHouseCurrentBookingsHistory,
        ]);
    }
    public function goToRatingsStaffHouse(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInCustomer')['id'];
        $staffHouseCurrentBookingsHistory = StaffHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            } catch (\Exception $e) {
                return false;
            }
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        return view('client.ratings.staffhouse', [
            'staffHouseCurrentBookingsHistory' => $staffHouseCurrentBookingsHistory,
        ]);
    }
    public function goToRatingsDftc(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInCustomer')['id'];
        $dftcCurrentBookingsHistory = DftcBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            try {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            } catch (\Exception $e) {
                return false;
            }
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
        });
        return view('client.ratings.dftc', [
            'dftcCurrentBookingsHistory' => $dftcCurrentBookingsHistory,
        ]);
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
        return view('client.rooms.guestHouseRooms', ['guestHouseRooms' => $guestHouseRooms, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToStaffHouseRooms(){
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
        foreach ($staffHouseRooms as $room) {
            $room->averageRating = $feedbacks->where('room_id', $room->id)->avg('ratings') ?? 0;
        }
        return view('client.rooms.staffHouseRooms', ['staffHouseRooms' => $staffHouseRooms, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcRooms(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $dftcRooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $booking = DftcBooking::where('status', 'Pending Review')->get();
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
        return view('client.rooms.dftcRooms', ['dftcRooms' => $dftcRooms , 'bookings' => $bookings, 'feedbacks' => $feedbacks, 'booking' => $booking]);
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
        return view('client.rooms.dftcHalls', ['dftcHalls' => $dftcHalls, 'bookings' => $bookings, 'feedbacks' => $feedbacks]);
    }
    public function goToDftcPreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('client.preBookings.dftcBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToStaffHousePreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('client.preBookings.staffHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToGuestHousePreBooking(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('client.preBookings.guestHouseBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function goToDftcPreBookingHall(Request $request){
        $data = json_decode($request->input('data'), true);
        $user = json_decode($request->input('user'), true);
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $roomnumbers = Room::where('facility_id', $facilityId)->get();
        return view('client.preBookings.dftcHallBook', ['roomnumbers' => $roomnumbers], compact('data', 'user'));
    }
    public function getRoomData(Request $request) {
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
    public function getRoomDataStaffHouseBook(Request $request) {
        $id = $request->input('room_number');
        $room = Room::find($id);

        if ($room) {
            return response()->json([
                'room_rate' => $room->room_rate,
                'room_capacity' => $room->room_capacity,
                'room_status' => $room->room_status
            ]);
        } else {
            return response()->json(['error' => 'Room not found'], 404);
        }
    }
    public function getRoomDataDftcBook(Request $request) {
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
    public function getRoomDataDftcHallBook(Request $request) {
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
