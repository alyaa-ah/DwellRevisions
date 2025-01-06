<?php

namespace App\Http\Controllers\AdminSH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\StaffHouseBooking;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueRoomNumber;
use App\Http\Controllers\Email\EmailController;
use App\Http\Controllers\Audit\AuditController;
class AdminSHFunctionController extends Controller
{
    public function goToDashboardAdminSH(){
        $now = Carbon::now('Asia/Manila');
        $client_id = session()->get('loggedInAdminSH')['id'];

        $staffHouseCurrentBookingsReviewed = StaffHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })
        ->count();
        $staffHouseCurrentBookingsNotReviewed = StaffHouseBooking::where('status', 'Pending Review')->count();

        $staffHouseVoidedBookings = StaffHouseBooking::where(function ($query) {
            $query->where('status', 'Rejected')
                ->orWhere('status', 'Canceled');
        })->count();

        $staffHouseCurrentBookingsHistory = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            })
            ->count();

        $staffHouseTotalBookingsAmount = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmounts = [];

        foreach ($staffHouseTotalBookingsAmount as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmounts[] = $totalAmount;
        }

        $totalAmountSum = array_sum($totalAmounts);
        $totalAmountSumFormatted = number_format($totalAmountSum, 2, '.', ',');

        $staffHouseBookings = StaffHouseBooking::where('status', 'Reviewed')
        ->get(['check_in_date', 'check_out_date', 'departure'])
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        });

        $staffHouseBookingsHistory = StaffHouseBooking::where('status', 'Reviewed')
        ->get(['check_in_date', 'check_out_date', 'departure'])
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime); // Keep bookings where checkout date is in the past
        });

        $staffHousePending = StaffHouseBooking::where('status', 'Pending Review')
            ->get(['check_in_date', 'check_out_date', 'departure']);

        $staffHouseVoids = StaffHouseBooking::where(function ($query) {
            $query->where('status', 'Rejected')
                ->orWhere('status', 'Canceled');
        })->get(['check_in_date', 'check_out_date', 'departure']);

        $staffHouseTotalBookings = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $labelsTotal = [];
        $dataStaffHouseTotal = [];
        $labels = [];
        $dataStaffHouse = [];
        $labelsHistory = [];
        $dataStaffHouseHistory = [];
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
            array_push($dataStaffHouseTotal, 0);
        }

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labels, $monthName);
            array_push($dataStaffHouse, 0);
        }


        foreach ($staffHouseTotalBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
                $dataStaffHouseTotal[$monthIndex] += $totalAmount;
            }
        }


        foreach ($staffHouseBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataStaffHouse[$monthIndex]++;
            }
        }


        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsHistory, $monthName);
            array_push($dataStaffHouseHistory, 0);
        }


        foreach ($staffHouseBookingsHistory as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataStaffHouseHistory[$monthIndex]++;
            }
        }


        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsPending, $monthName);
            array_push($dataSetsPending, 0);
        }


        foreach ($staffHousePending as $pendingBooking) {
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


        foreach ($staffHouseVoids as $voidBooking) {
            if ($voidBooking->check_in_date) {
                $checkInDate = Carbon::parse($voidBooking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $dataSetsVoids[$monthIndex]++;
            }
        }


        $dataSets = [
            [
                'label' => 'Current Data',
                'data' => $dataStaffHouse,
                'backgroundColor' => $colors
            ]
        ];

        $dataSetshistory = [
            [
                'label' => 'Historical Data',
                'data' => $dataStaffHouseHistory,
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
                'data' => $dataStaffHouseTotal,
                'backgroundColor' => $colors
            ]
        ];

        return view('adminSH.dashboard' , [
            'staffHouseCurrentBookingsReviewed' => $staffHouseCurrentBookingsReviewed,
            'staffHouseCurrentBookingsNotReviewed' => $staffHouseCurrentBookingsNotReviewed,
            'staffHouseCurrentBookingsHistory' => $staffHouseCurrentBookingsHistory,
            'staffHouseVoidedBookings' => $staffHouseVoidedBookings,
            'totalAmountSumFormatted' => $totalAmountSumFormatted,
        ],
        compact(
            'labels', 'dataSets', 'labelsHistory', 'dataSetshistory',
            'labelsPending', 'dataSetsPending', 'voidsLabels', 'voidsDataSets',
            'labelsTotal', 'dataSetsTotal'
        ));
    }
    public function goToAddRoomAdminSH(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $facilities = Facility::all();
        return view('adminSH.functions.room.add-room', ['facilities' => $facilities, 'rooms' => $rooms]);
    }
    public function goToRooms(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $facilities = Facility::all();
        $rooms = Room::where('facility_id', $facilityId)->get();
        $countRooms = count($rooms);
        return view('adminSH.functions.room.view-rooms', ['rooms' => $rooms, 'countRooms' => $countRooms, 'facilities' => $facilities]);
    }
    public function editRoomAdminSH(Request $request){
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
        $clientId = session()->get('loggedInAdminSH')['id'];
        $fullname = session()->get('loggedInAdminSH')['fullname'];
        $role = session()->get('loggedInAdminSH')['role'];
        $activity = "Modified a staff house room in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        $updateResult = Room::where('id', $request->room_id)->update($roomData);

        return $updateResult ? 1 : 0;
    }
    public function addRoomAdminSH(Request $request){
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
            $clientId = session()->get('loggedInAdminSH')['id'];
            $fullname = session()->get('loggedInAdminSH')['fullname'];
            $role = session()->get('loggedInAdminSH')['role'];
            $activity = "Added a staff house room in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            $room->save();
            return !is_null($room) ? 1 : 0;
        }
    }
    public function deleteRoomAdminSH(Request $request){
        $deleteResult = Room::where('id', $request->room_id)->delete();
        $clientId = session()->get('loggedInAdminSH')['id'];
        $fullname = session()->get('loggedInAdminSH')['fullname'];
        $role = session()->get('loggedInAdminSH')['role'];
        $activity = "Deleted a staff house room in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $deleteResult? 1 : 0;
    }
    public function viewStaffHouseBookingAdminSH(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $facilities = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
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
        return view('adminSH.functions.staffhouse.view-bookings', [
            'bookings' => $bookings,
            'facilities' => $facilities,
            'countBookings' => $countBookings
        ]);
    }
    public function viewStaffHousePendingBookingAdminSH(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $facilities = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Pending Review')
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
        return view('adminSH.functions.staffhouse.view-pendings', [
            'bookings' => $bookings,
            'facilities' => $facilities,
            'countBookings' => $countBookings
        ]);
    }
    public function updateStaffHouseBookingStatusAdminSH(Request $request){
        $status = $request->status;
        $bookingId = $request->booking_id;
        $bookings = StaffHouseBooking::where('id', $bookingId)->first();
        if($bookings->status != "Pending Review"){
            return 404;
        }else{
            switch ($status) {
                case 'Reviewed':
                    $bookings = StaffHouseBooking::where('id', $bookingId)->first();
                    if ($bookings) {
                        $bookings->update([
                            'status' => 'Reviewed',
                        ]);
                        $facility = Facility::where('facility_name', 'Staff House')->first();
                        (new EmailController)->sendReviewNotification(
                            $bookings->email,
                            $bookings->fullname,
                            $bookings->SH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Reviewed',
                            null
                        );
                        $superAdmin = Client::where('role', 'SuperAdmin')->first();
                        $admin = Client::where('role', 'adminSH')->first();
                        (new EmailController)->newPreReservation(
                            $superAdmin->email,
                            $superAdmin->fullname,
                            $admin->fullname,
                            $bookings->fullname,
                            $bookings->SH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Reviewed'
                        );
                        $clientId = session()->get('loggedInAdminSH')['id'];
                        $fullname = session()->get('loggedInAdminSH')['fullname'];
                        $role = session()->get('loggedInAdminSH')['role'];
                        $activity = "Reviewed a staff house pre-reservation in the system.";
                        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
                        return $bookings ? 1 : 0;
                    } else {
                        return 0;
                    }
                    break;

                case 'Rejected':
                    $bookings = StaffHouseBooking::where('id', $bookingId)->first();
                    if ($bookings) {
                        $reason = $request->reason === 'Others' ? $request->other_reason : $request->reason;
                        $$bookings->update([
                            'status' => 'Rejected',
                            'reason' => $reason,
                        ]);

                        $facility = Facility::where('facility_name', 'Staff House')->first();
                        (new EmailController)->sendReviewNotification(
                            $bookings->email,
                            $bookings->fullname,
                            $bookings->SH_number,
                            $facility->facility_name,
                            $bookings->room_number,
                            'Rejected',
                            $request->reason
                        );
                        $clientId = session()->get('loggedInAdminSH')['id'];
                        $fullname = session()->get('loggedInAdminSH')['fullname'];
                        $role = session()->get('loggedInAdminSH')['role'];
                        $activity = "Rejected a staff house pre-reservation in the system.";
                        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
                        return $bookings ? 1 : 0;
                    } else {
                        return 0;
                    }
                    break;
            }
        }
    }
    public function goToStaffHouseBookingHistoryAdminSH(){
        $now = Carbon::now('Asia/Manila');
        $bookings = StaffHouseBooking::where('status', 'Reviewed')
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
        return view('adminSH.functions.staffhouse.view-history', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToCanceledBookingsAdminSH(){
        $bookings = StaffHouseBooking::where('status', 'Canceled')
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminSH.functions.staffhouse.view-cancellations', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToRejectedBookingsAdminSH(){
        $bookings = StaffHouseBooking::where('status', 'Rejected')
        ->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('adminSH.functions.staffhouse.view-rejections', [
            'bookings' => $bookings,
            'countBookings' => $countBookings
        ]);
    }
    public function goToAccountAdminSH(){
        $client_id = session()->get('loggedInAdminSH')['id'];
        $clients = Client::where('id', $client_id)->get();
        return view('adminSH.functions.account.view-account', ['clients' => $clients]);
    }
    public function editAdminSHAccount(Request $request){
        $client = Client::where('id', $request->client_id)->first();
        $validator = Validator::make($request->all(), [
            'fullname' =>'required|max:100',
            'agency' =>'required|max:50',
            'address' =>'required|max:100',
            'position' =>'required',
            'contact' =>'required|min:13|max:13',
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
            $clientId = session()->get('loggedInAdminSH')['id'];
            $fullname = session()->get('loggedInAdminSH')['fullname'];
            $role = session()->get('loggedInAdminSH')['role'];
            $activity = "Modified own account in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            $client->update($updateData);
            return response()->json(['status' => '200']);
        }

        return response()->json(['status' => '404']);
    }
    public function updateCheckOut(Request $request){
        $booking = StaffHouseBooking::find($request->booking_id);
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


                preg_match('/\+(\s*\d+)\s*days/', $request->newremarks, $matches);

                $extendedDays = isset($matches[1]) ? (int)trim($matches[1]) : 0;


                $additionalCost = 0;

                if ($extendedDays > 0) {
                    $additionalCost = $extendedDays * $booking->rate;
                }
                try {
                    $checkOutDate = Carbon::createFromFormat('Y-m-d', $request->extendedCheckOutDate)
                        ->setTimezone('Asia/Manila')
                        ->format('F j, Y');
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Invalid date format'], 400);
                }

                $booking->check_out_date = $checkOutDate;
                $booking->remarks = $request->newremarks;
                if ($booking->total_amount != 0.00) {
                    $booking->total_amount += $additionalCost;
                }
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
