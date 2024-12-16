<?php

namespace App\Http\Controllers\AdminGH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\GuestHouseBooking;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueRoomNumber;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Audit\AuditController;
class AdminGHFunctionController extends Controller
{
    public function goToDashboardAdminGH(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInAdminGH')['id'];
        $guestHouseCurrentBookingsReviewed = GuestHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })
        ->count();

        $guestHouseCurrentBookingsNotReviewed = GuestHouseBooking::where('status', 'Pending Review')
            ->count();

        $guestHouseVoidedBookings = GuestHouseBooking::where(function ($query) {
            $query->where('status', 'Rejected')
                ->orWhere('status', 'Canceled');
        })->count();

        $guestHouseCurrentBookingsHistory = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            })
            ->count();

        $guestHouseTotalBookingsAmount = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmounts = [];

        foreach ($guestHouseTotalBookingsAmount as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmounts[] = $totalAmount;
        }

        $totalAmountSum = array_sum($totalAmounts);
        $totalAmountSumFormatted = number_format($totalAmountSum, 2, '.', ',');

        $guestHouseBookings = GuestHouseBooking::where('status', 'Reviewed')
            ->get(['check_in_date', 'check_out_date', 'departure'])
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->lte($checkOutDateTime);
        });

        $guestHouseBookingsHistory = GuestHouseBooking::where('status', 'Reviewed')
            ->get(['check_in_date', 'check_out_date', 'departure'])
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime); // Keep bookings where checkout date is in the past
            });

        $guestHousePending = GuestHouseBooking::where('status', 'Pending Review')
        ->get(['check_in_date', 'check_out_date', 'departure']);

        $guestHouseVoids = GuestHouseBooking::where(function ($query) {
            $query->where('status', 'Rejected')
                ->orWhere('status', 'Canceled');
        })->get(['check_in_date', 'check_out_date', 'departure']);

        $guestHouseTotalBookings = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $labelsTotal = [];
        $dataGuestHouseTotal = [];
        $labels = [];
        $dataGuestHouse = [];
        $labelsHistory = [];
        $dataGuestHouseHistory = [];
        $labelsPending = [];
        $dataSetsPending = [];
        $voidsLabels = [];
        $dataSetsVoids = [];
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
        ];


        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsTotal, $monthName);
            array_push($dataGuestHouseTotal, 0);
        }

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labels, $monthName);
            array_push($dataGuestHouse, 0);
        }

        foreach ($guestHouseTotalBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
                $dataGuestHouseTotal[$monthIndex] += $totalAmount;
            }
        }

        foreach ($guestHouseBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataGuestHouse[$monthIndex]++;
            }
        }

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsHistory, $monthName);
            array_push($dataGuestHouseHistory, 0);
        }


        foreach ($guestHouseBookingsHistory as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataGuestHouseHistory[$monthIndex]++;
            }
        }


        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsPending, $monthName);
            array_push($dataSetsPending, 0);
        }


        foreach ($guestHousePending as $pendingBooking) {
            if ($pendingBooking->check_in_date) {
                $checkInDate = Carbon::parse($pendingBooking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataSetsPending[$monthIndex]++;
            }
        }


        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($voidsLabels, $monthName);
            array_push($dataSetsVoids, 0);
        }


        foreach ($guestHouseVoids as $voidBooking) {
            if ($voidBooking->check_in_date) {
                $checkInDate = Carbon::parse($voidBooking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataSetsVoids[$monthIndex]++;
            }
        }


        $dataSets = [
            [
                'label' => 'Current Data',
                'data' => $dataGuestHouse,
                'backgroundColor' => $colors
            ]
        ];

        $dataSetshistory = [
            [
                'label' => 'Historical Data',
                'data' => $dataGuestHouseHistory,
                'backgroundColor' => $colors
            ]
        ];

        $dataSetsPending = [
            [
                'label' => 'Pending Data',
                'data' => $dataSetsPending,
                'backgroundColor' => $colors
            ]
        ];

        $voidsDataSets = [
            [
                'label' => 'Voided Data',
                'data' => $dataSetsVoids,
                'backgroundColor' => $colors
            ]
        ];

        $dataSetsTotal = [
            [
                'label' => 'Total Amount',
                'data' => $dataGuestHouseTotal,
                'backgroundColor' => $colors
            ]
        ];

        return view('adminGH.dashboard' , [
            'guestHouseCurrentBookingsReviewed' => $guestHouseCurrentBookingsReviewed,
            'guestHouseCurrentBookingsNotReviewed' => $guestHouseCurrentBookingsNotReviewed,
            'guestHouseCurrentBookingsHistory' => $guestHouseCurrentBookingsHistory,
            'guestHouseVoidedBookings' => $guestHouseVoidedBookings,
            'totalAmountSumFormatted' => $totalAmountSumFormatted,
        ],
        compact(
            'labels', 'dataSets', 'labelsHistory', 'dataSetshistory',
            'labelsPending', 'dataSetsPending', 'voidsLabels', 'voidsDataSets',
            'labelsTotal', 'dataSetsTotal'
        ));
    }
    public function goToAddRoomAdminGH(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $facilities = Facility::all();
        return view('adminGH.functions.room.add-room', ['facilities' => $facilities, 'rooms' => $rooms]);
    }
    public function goToRooms(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $facilities = Facility::all();
        $rooms = Room::where('facility_id', $facilityId)->get();
        $countRooms = count($rooms);
        return view('adminGH.functions.room.view-rooms', ['rooms' => $rooms, 'countRooms' => $countRooms, 'facilities' => $facilities]);
    }
    public function editRoomAdminGH(Request $request){
        $validator = Validator::make($request->all(), [
            'facility' => 'required',
            'room_type' => 'required',
            'room_number' => 'required',
            'room_rate' => 'required',
            'room_capacity' => 'required',
            'room_description' => 'required|max:500',
            'room_amenities' => 'required|max:500',
            'room_inclusion' => 'required|max:500',
            'room_photo1' =>'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'room_photo2' =>'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'room_photo3' =>'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        }
        $roomData = [
            'facility_id' => $request->facility,
            'room_type' => $request->room_type,
            'room_number' => $request->room_number,
            'room_rate' => $request->room_rate,
            'room_status' => $request->room_status,
            'room_capacity' => $request->room_capacity,
            'room_description' => $request->room_description,
            'room_amenities' => $request->room_amenities,
            'room_inclusion' => $request->room_inclusion
        ];

        $files = ['room_photo1', 'room_photo2', 'room_photo3'];

        foreach ($files as $key => $fileKey) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $key . '.' . $extension;
                    $file->move(public_path('photos/rooms'), $filename);
                    $roomData[$fileKey] = $filename;
                } else {
                    return redirect()->back()->withInput()->withErrors(['Invalid file uploaded for ' . $fileKey]);
                }
            }
        }
        $client_id = session()->get('loggedInAdminGH')['id'];
        $fullname = session()->get('loggedInAdminGH')['fullname'];
        $role = session()->get('loggedInAdminGH')['role'];
        $activity = "Modified a guest house room information in the system.";
        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
        $updateResult = Room::where('id', $request->room_id)->update($roomData);
        return $updateResult ? 1 : 0;
    }
    public function addRoomAdminGH(Request $request){
        $validator = Validator::make($request->all(), [
            'facility' => 'required',
            'room_type' => 'required',
            'room_number' => ['required', new UniqueRoomNumber($request->facility)],
            'room_rate' => 'required',
            'room_capacity' => 'required',
            'room_description' => 'required|max:500',
            'room_amenities' => 'required|max:500',
            'room_inclusion' => 'required|max:500',
            'room_photo1' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'room_photo2' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'room_photo3' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ]);
        } else {
            $room = new Room();
            $room->facility_id = $request->facility;
            $room->room_type = $request->room_type;
            $room->room_number = strtoupper($request->room_number);
            $room->room_rate = $request->room_rate;
            $room->room_status = $request->room_status;
            $room->room_capacity = $request->room_capacity;
            $room->room_description = ucfirst($request->room_description);
            $room->room_amenities = ucfirst($request->room_amenities);
            $room->room_inclusion = ucfirst($request->room_inclusion);

            $files = ['room_photo1', 'room_photo2', 'room_photo3'];

            foreach ($files as $key => $fileKey) {
                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    if ($file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '_' . $key . '.' . $extension;
                        $file->move(public_path('photos/rooms'), $filename);
                        $room->{$fileKey} = $filename;
                    } else {
                        return redirect()->back()->withInput()->withErrors(['Invalid file uploaded for ' . $fileKey]);
                    }
                }
            }
            $client_id = session()->get('loggedInAdminGH')['id'];
            $fullname = session()->get('loggedInAdminGH')['fullname'];
            $role = session()->get('loggedInAdminGH')['role'];
            $activity = "Added a guest house room in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            $room->save();
            return !is_null($room) ? 1 : 0;
        }
    }
    public function deleteRoomAdminGH(Request $request){
        $deleteResult = Room::where('id', $request->room_id)->delete();
        $client_id = session()->get('loggedInAdminGH')['id'];
        $fullname = session()->get('loggedInAdminGH')['fullname'];
        $role = session()->get('loggedInAdminGH')['role'];
        $activity = "Deleted a guest house room in the system.";
        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
        return $deleteResult? 1 : 0;
    }
    public function viewGuestHouseBookingAdminGH(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $facilities = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
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
        return view('adminGH.functions.guesthouse.view-bookings', [
            'bookings' => $bookings,
            'facilities' => $facilities,
            'countBookings' => $countBookings
        ]);
    }
    public function viewGuestHousePendingBookingAdminGH(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $facilities = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Pending Review')
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
        return view('adminGH.functions.guesthouse.view-pendings', [
            'bookings' => $bookings,
            'facilities' => $facilities,
            'countBookings' => $countBookings
        ]);
    }
    public function updateGuestHouseBookingStatusAdminGH(Request $request){
        $status = $request->status;
        $bookingId = $request->booking_id;
        $booking = GuestHouseBooking::where('id', $bookingId)->first();
        if($booking->status != "Pending Review"){
            return 404;
        }else{
            switch ($status) {
                case 'Reviewed':
                    $bookings = GuestHouseBooking::where('id', $bookingId)->first();
                    if ($bookings) {
                        $bookings->update([
                            'status' => 'Reviewed',
                        ]);
                        $facility = Facility::where('facility_name', 'Guest House')->first();
                        (new EmailController)->sendReviewNotification(
                            $bookings->email,
                            $bookings->fullname,
                            $bookings->GH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Reviewed',
                            null
                        );
                        $superAdmin = Client::where('role', 'SuperAdmin')->first();
                        $admin = Client::where('role', 'adminGH')->first();
                        (new EmailController)->newPreReservation(
                            $superAdmin->email,
                            $superAdmin->fullname,
                            $admin->fullname,
                            $bookings->fullname,
                            $bookings->GH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Reviewed'
                        );
                        $client_id = session()->get('loggedInAdminGH')['id'];
                        $fullname = session()->get('loggedInAdminGH')['fullname'];
                        $role = session()->get('loggedInAdminGH')['role'];
                        $activity = "Changed status of pre-reservation in the system.";
                        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                        return $bookings ? 1 : 0;
                    } else {
                        return 0;
                    }
                    break;

                case 'Rejected':
                    $bookings = GuestHouseBooking::where('id', $bookingId)->first();
                    if ($bookings) {
                        $reason = $request->reason === 'Others' ? $request->other_reason : $request->reason;
                        $bookings->update([
                            'status' => 'Rejected',
                            'reason' => $reason,
                        ]);

                        $facility = Facility::where('facility_name', 'Guest House')->first();
                        (new EmailController)->sendReviewNotification(
                            $bookings->email,
                            $bookings->fullname,
                            $bookings->GH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Rejected',
                            $request->reason
                        );
                        $client_id = session()->get('loggedInAdminGH')['id'];
                        $fullname = session()->get('loggedInAdminGH')['fullname'];
                        $role = session()->get('loggedInAdminGH')['role'];
                        $activity = "Changed status of pre-reservation in the system.";
                        (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
                        return $bookings ? 1 : 0;
                    } else {
                        return 0;
                    }
                    break;
            }
        }
    }
    public function goToGuestHouseBookingHistoryAdminGH(){
        $now = Carbon::now('Asia/Manila');
        $bookings = GuestHouseBooking::where('status', 'Reviewed')
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
        return view('adminGH.functions.guesthouse.view-history', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToCanceledBookingsAdminGH(){
        $bookings = GuestHouseBooking::where('status', 'Canceled')
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });;
        $countBookings = count($bookings);
        return view('adminGH.functions.guesthouse.view-cancellations', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToRejectedBookingsAdminGH(){
        $bookings = GuestHouseBooking::where('status', 'Rejected')
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });;
        $countBookings = count($bookings);
        return view('adminGH.functions.guesthouse.view-rejections', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToAccountAdminGH(){
        $client_id = session()->get('loggedInAdminGH')['id'];
        $clients = Client::where('id', $client_id)->get();
        return view('adminGH.functions.account.view-account', ['clients' => $clients]);
    }
    public function editAdminGHAccount(Request $request){
        $client = Client::where('id', $request->client_id)->first();
        $validator = Validator::make($request->all(), [
            'fullname' =>'required|max:100',
            'agency' =>'required|min:6|max:50',
            'address' =>'required|min:6|max:100',
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
        }
        if (!Hash::check($request->input('old_password'), $client->password)) {
            return 2;
        }
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

        if (!is_null($client)) {
            $client->update($updateData);
            $client_id = session()->get('loggedInAdminGH')['id'];
            $fullname = session()->get('loggedInAdminGH')['fullname'];
            $role = session()->get('loggedInAdminGH')['role'];
            $activity = "Modified own account in the system.";
            (new AuditController)->createAuditTrail($fullname ,$client_id, $activity , $role);
            return response()->json(['status' => '200']);
        }
        return response()->json(['status' => '404']);
    }
    public function updateCheckOut(Request $request){
        $booking = GuestHouseBooking::find($request->booking_id);
        $orig = $booking->check_out_date;
        if (!$booking) {
            return 404;
        }

        try {
            if ($request->remarks == 'Early Check Out') {
                if (!$request->earlyCheckOutDate) {
                    return 400;
                }

                $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->earlyCheckOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
                $booking->check_out_date = $checkOutDate;
                $booking->remarks = $request->newremarks;

                if ($booking->save()) {
                    return 200;
                }

                return 500;
            }

            if ($request->remarks == 'Extended') {
                if (!$request->extendedCheckOutDate) {
                    return 400;
                }
                $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->extendedCheckOutDate)->setTimezone('Asia/Manila')->format('F j, Y');
                $booking->check_out_date = $checkOutDate;
                $booking->remarks = $request->newremarks;

                if ($booking->save()) {
                    return 200;
                }

                return 500;
            }

            return 400; // Bad Request
        } catch (\Exception $e) {
            return 500;
        }
    }


}
