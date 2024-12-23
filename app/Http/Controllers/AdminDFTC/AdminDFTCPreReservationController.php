<?php

namespace App\Http\Controllers\AdminDFTC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use Carbon\Carbon;
use App\Models\Facility;
use App\Models\Room;
use App\Models\Client;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Audit\AuditController;
class AdminDFTCPreReservationController extends Controller
{
    public function goToAdminDftcPreReservation(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
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
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.guesthouse.view-bookings', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function cancelGuestHouseBookingsAdminDftc(Request $request){
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
            $clientId = session()->get('loggedInAdminDftc')['id'];
            $fullname = session()->get('loggedInAdminDftc')['fullname'];
            $role = session()->get('loggedInAdminDftc')['role'];
            $activity = "Canceled a guest house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function goToPreReservationStaffHouseAdminDftc(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
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
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.staffhouse.view-bookings', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function cancelStaffHouseBookingsAdminDftc(Request $request){
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
            $clientId = session()->get('loggedInAdminDftc')['id'];
            $fullname = session()->get('loggedInAdminDftc')['fullname'];
            $role = session()->get('loggedInAdminDftc')['role'];
            $activity = "Canceled a staff house pre-reservation in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return 1;
        } else {
            return 0;
        }
    }
    public function goToDftcReservationAdminDftc(){
        $client_id = session()->get('loggedInAdminDftc')['id'];
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
        return view('adminDftc.myPre-reservations.DFTC.view-bookings' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function cancelDftcBookingsAdminDftc(Request $request){
        $dftcBooking = DftcBooking::where('id', $request->booking_id)->update([
            'status' => 'Canceled',
            'reason' => $request->reason,
        ]);
        $clientId = session()->get('loggedInAdminDftc')['id'];
        $fullname = session()->get('loggedInAdminDftc')['fullname'];
        $role = session()->get('loggedInAdminDftc')['role'];
        $activity = "Canceled a DFTC pre-reservation in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return !is_null($dftcBooking) ? 1 : 0;
    }
    public function goToAdminDftcGuestHouseHistory(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.guesthouse.view-history', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcStaffHouseHistory(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
        ->where('client_id', $client_id)
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.staffhouse.view-history', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcDftcHistory(){
        $client_id = session()->get('loggedInAdminDftc')['id'];
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
            return $now->gte($checkOutDateTime);
        })
        ->map(function ($booking) use ($rooms, $now) {
            if (isset($rooms[$booking->room_id])) {
                $booking->room_type = $rooms[$booking->room_id]->room_type;
            } else {
                $booking->room_type = null;
            }
            return $booking;
        })
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.DFTC.view-history', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcCanceledBookingsGuestHouse() {
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = GuestHouseBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get();
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.guesthouse.view-cancellations', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcRejectedBookingsGuestHouse() {
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = GuestHouseBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.guesthouse.view-rejections', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcCanceledBookingsStaffHouse() {
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = GuestHouseBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.staffhouse.view-cancellations', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcRejectedBookingsStaffHouse() {
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = StaffHouseBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.staffhouse.view-rejections', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcCanceledBookingsDftc() {
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = DftcBooking::where('status', 'Canceled')
        ->where('client_id', $client_id)
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.DFTC.view-cancellations', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
    public function goToAdminDftcRejectedBookingsDftc() {
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $client_id = session()->get('loggedInAdminDftc')['id'];
        $bookings = DftcBooking::where('status', 'Rejected')
        ->where('client_id', $client_id)
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->DFTC_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminDftc.myPre-reservations.DFTC.view-rejections', [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'countBookings' => $countBookings,
        ]);
    }
}
