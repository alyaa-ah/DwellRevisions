<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;
use App\Models\GuestHouseBooking;
use App\Models\StaffHouseBooking;
use App\Models\DftcBooking;
use App\Models\Client;
use App\Models\Audit;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Rules\UniqueRoomNumber;
use App\Http\Controllers\Audit\AuditController;
class SuperAdminFunctionController extends Controller
{
    public function index(){
        return view('superAdmin.index');
    }
    public function goToDashboard() {
        $now = Carbon::now('Asia/Manila');
        $GuestHouseTotalBookingsAmount = GuestHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmountsGuestHouse = [];
        foreach ($GuestHouseTotalBookingsAmount as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsGuestHouse[] = $totalAmount;
        }

        $totalAmountSumGuestHouse = array_sum($totalAmountsGuestHouse);
        $totalAmountSumFormattedGuestHouse = number_format($totalAmountSumGuestHouse, 2, '.', ',');

        $StaffHouseTotalBookingsAmount = StaffHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });

        $totalAmountsStaffHouse = [];
        foreach ($StaffHouseTotalBookingsAmount as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsStaffHouse[] = $totalAmount;
        }
        $totalAmountSumStaffHouse = array_sum($totalAmountsStaffHouse);
        $totalAmountSumFormattedStaffHouse = number_format($totalAmountSumStaffHouse, 2, '.', ',');
        $DftcTotalBookingsAmount = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmountsDftc = [];
        foreach ($DftcTotalBookingsAmount as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsDftc[] = $totalAmount;
        }

        $totalAmountSumDftc = array_sum($totalAmountsDftc);
        $totalAmountSumFormattedDftc = number_format($totalAmountSumDftc, 2, '.', ',');
        $DftcTotalBookings = DftcBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $labelsTotalDftc = [];
        $dataDftcTotal = [];
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
        ];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsTotalDftc, $monthName);
            array_push($dataDftcTotal, 0);
        }
        foreach ($DftcTotalBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
                $dataDftcTotal[$monthIndex] += $totalAmount;
            }
        }
        $dataSetsTotalDftc = [
            [
                'label' => 'DFTC Total Amount',
                'data' => $dataDftcTotal,
                'backgroundColor' => $colors
            ]
        ];
        $StaffHouseTotalBookings = StaffHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });

        $labelsTotalStaffHouse = [];
        $dataStaffHouseTotal = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsTotalStaffHouse, $monthName);
            array_push($dataStaffHouseTotal, 0);
        }

        foreach ($StaffHouseTotalBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
                $dataStaffHouseTotal[$monthIndex] += $totalAmount;
            }
        }

        $dataSetsTotalStaffHouse = [
            [
                'label' => 'Staff House Total Amount',
                'data' => $dataStaffHouseTotal,
                'backgroundColor' => $colors
            ]
        ];
        $GuestHouseTotalBookings = GuestHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });

        $labelsTotalGuestHouse = [];
        $dataGuestHouseTotal = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('F');
            array_push($labelsTotalGuestHouse, $monthName);
            array_push($dataGuestHouseTotal, 0);
        }

        foreach ($GuestHouseTotalBookings as $booking) {
            if ($booking->check_in_date) {
                $checkInDate = Carbon::parse($booking->check_in_date);
                $monthIndex = $checkInDate->month - 1;
                $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
                $dataGuestHouseTotal[$monthIndex] += $totalAmount;
            }
        }
        $dataSetsTotalGuestHouse = [
            [
                'label' => 'Guest House Total Amount',
                'data' => $dataGuestHouseTotal,
                'backgroundColor' => $colors
            ]
        ];
        $guestHouseTotalBookings = GuestHouseBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });

        $totalAmountsGuestHouse = [];
        foreach ($guestHouseTotalBookings as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsGuestHouse[] = $totalAmount;
        }

        $totalAmountSumGuestHouse = array_sum($totalAmountsGuestHouse);

        $staffHouseTotalBookings = StaffHouseBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmountsStaffHouse = [];
        foreach ($staffHouseTotalBookings as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsStaffHouse[] = $totalAmount;
        }

        $totalAmountSumStaffHouse = array_sum($totalAmountsStaffHouse);

        $dftcTotalBookings = DftcBooking::where('status', 'Reviewed')
            ->get()
            ->filter(function ($booking) use ($now) {
                $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
                $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
                $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
                return $now->gte($checkOutDateTime);
            });

        $totalAmountsDftc = [];
        foreach ($dftcTotalBookings as $booking) {
            $totalAmount = $booking->total_amount - ($booking->janitor_services + $booking->av_services);
            $totalAmountsDftc[] = $totalAmount;
        }


        $totalAmountSumTotal = $totalAmountSumGuestHouse + $totalAmountSumStaffHouse + $totalAmountSumDftc;
        $totalAmountSumFormatted = number_format($totalAmountSumTotal, 2, '.', ',');

        $labelsTotal = ['Guest House', 'Staff House', 'DFTC'];
        $dataTotal = [$totalAmountSumGuestHouse, $totalAmountSumStaffHouse, $totalAmountSumDftc];
        return view('superAdmin.dashboard',[
            'totalAmountSumFormattedDftc' => $totalAmountSumFormattedDftc,
            'totalAmountSumFormattedStaffHouse' => $totalAmountSumFormattedStaffHouse,
            'totalAmountSumFormattedGuestHouse' => $totalAmountSumFormattedGuestHouse,
            'totalAmountSumTotal' => $totalAmountSumFormatted
        ],
        compact(
            'labelsTotalDftc',
            'dataSetsTotalDftc',
            'dataSetsTotalStaffHouse',
            'labelsTotalStaffHouse',
            'dataSetsTotalGuestHouse',
            'labelsTotalGuestHouse',
            'dataTotal',
            'labelsTotal'
        ));
    }
    public function goToViewRooms() {
        $facilities = Facility::all();
        $roomsData = Room::join('facilities', 'rooms.facility_id', '=', 'facilities.id')->select('rooms.*', 'facilities.facility_name')->get();
        $rooms = $roomsData->map(function ($item) {
            $room = new Room();
            $room->facility_id = $item->facility_id;
            $room->facility_name = $item->facility_name;
            $room->id = $item->id;
            $room->room_number = $item->room_number;
            $room->room_type = $item->room_type;
            $room->room_rate = $item->room_rate;
            $room->room_capacity = $item->room_capacity;
            $room->room_description = $item->room_description;
            $room->room_amenities = $item->room_amenities;
            $room->room_inclusion = $item->room_inclusion;
            $room->room_status = $item->room_status;
            $room->room_photo1 = $item->room_photo1;
            $room->room_photo2 = $item->room_photo2;
            $room->room_photo3 = $item->room_photo3;
            return $room;
        });
        $countRooms = count($rooms);
        return view('superAdmin.functions.rooms.view-rooms', ['rooms' => $rooms , 'facilities' => $facilities, 'countRooms' => $countRooms]);
    }
    public function goToAddRoom() {
        $facilities = Facility::all();
        return view('superAdmin.functions.rooms.add-room', compact('facilities'));
    }
    public function goToViewGuestHouseBooking() {
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
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

        return view('superAdmin.functions.guesthouse.view-bookings' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToViewStaffHouseBooking() {
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
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
        return view('superAdmin.functions.staffhouse.view-bookings' , ['bookings' => $bookings] , ['rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToViewDftcRoomBooking() {
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get()->keyBy('id');
        $now = Carbon::now('Asia/Manila');
        $bookings = DftcBooking::where('status', 'Reviewed')->get()
        ->filter(function ($booking) use ($now, $rooms) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->lte($checkOutDateTime);
        })
        ->map(function ($booking) use ($rooms) {
            if (isset($rooms[$booking->room_id])) {
                $booking->room_type = $rooms[$booking->room_id]->room_type;
            } else {
                $booking->room_type = null;
            }
            return $booking;
        });
        $countBookings = count($bookings);
        return view('superAdmin.functions.DFTC.view-bookings' , ['bookings' => $bookings, 'rooms' => $rooms, 'countBookings' => $countBookings]);
    }
    public function goToGuestHouseHistory(){
        $facilityId = Facility::where('facility_name', 'Guest House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
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
        return view('superAdmin.functions.guesthouse.view-history', [
            'bookings' => $bookings,
            'rooms' => $rooms,
            'countBookings' => $countBookings,
        ],
        );
    }

    public function goToStaffHouseHistory(){
        $facilityId = Facility::where('facility_name', 'Staff House')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
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

        return view('superAdmin.functions.staffhouse.view-history', [
            'bookings' => $bookings,
            'rooms' => $rooms,
            'countBookings' => $countBookings,
        ],
        compact('countBookings')
        );
    }
    public function gotoDftcHistory(){
        $facilityId = Facility::where('facility_name', 'DFTC')->value('id');
        $rooms = Room::where('facility_id', $facilityId)->get();
        $now = Carbon::now('Asia/Manila');

        $bookings = DftcBooking::where('status', 'Reviewed')
        ->get()
        ->filter(function ($booking) use ($now) {
            $checkOutDate = Carbon::createFromFormat('F j, Y', $booking->check_out_date, 'Asia/Manila');
            $departureTime = Carbon::createFromFormat('h:i A', $booking->departure, 'Asia/Manila');
            $checkOutDateTime = $checkOutDate->setTimeFrom($departureTime);
            return $now->gte($checkOutDateTime);
        });
        $countBookings = count($bookings);
        return view('superAdmin.functions.DFTC.view-history', [
            'bookings' => $bookings,
            'rooms' => $rooms,
            'countBookings' => $countBookings,
        ],
        compact('countBookings')
        );
    }
    public function goToVoidGuestHouseBookings(){
        $bookings = GuestHouseBooking::where('status', 'Canceled')->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });;
        $countBookings = count($bookings);
        return view('superAdmin.functions.guesthouse.view-voided', ['bookings' => $bookings , 'countBookings' => $countBookings]);
    }
    public function goToVoidStaffHouseBookings(){
        $bookings = StaffHouseBooking::where('status', 'Canceled')->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('superAdmin.functions.staffhouse.view-voided', ['bookings' => $bookings, 'countBookings' => $countBookings]);
    }
    public function goToVoidDftcBookings(){
        $bookings = DftcBooking::where('status', 'Canceled')->get();
        $countBookings = count($bookings);
        return view('superAdmin.functions.DFTC.view-voided', ['bookings' => $bookings, 'countBookings' => $countBookings]);
    }
    public function goToRejectedGuestHouseBooking(){
        $bookings = GuestHouseBooking::where('status', 'Rejected')->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->GH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('superAdmin.functions.guesthouse.view-rejected', ['bookings' => $bookings, 'countBookings' => $countBookings]);
    }
    public function goToRejectedStaffHouseBooking(){
        $bookings = StaffHouseBooking::where('status', 'Rejected')->get()
        ->sortByDesc(function ($booking) {
            return Carbon::createFromFormat('F j, Y h:i A', $booking->SH_date, 'Asia/Manila');
        });
        $countBookings = count($bookings);
        return view('superAdmin.functions.staffhouse.view-rejected', ['bookings' => $bookings, 'countBookings' => $countBookings]);
    }
    public function goToRejectedDftcBooking(){
        $bookings = StaffHouseBooking::where('status', 'Rejected')->get();
        $countBookings = count($bookings);
        return view('superAdmin.functions.DFTC.view-rejected', ['bookings' => $bookings, 'countBookings' => $countBookings]);
    }
    public function goToClients(){
        $clients = Client::where('role', '!=', 'SuperAdmin')->get();
        $rolesCount = $clients->reduce(function ($carry, $client){
            if(!isset($carry[$client->role])){
                $carry[$client->role] = 0;
            }
            $carry[$client->role]++;
            return $carry;
        }, ['AdminGH' => 0, 'AdminSH' => 0, 'AdminDFTC' => 0]);
        $roleOptions = [
            'AdminGH' => 'Guest House Admin',
            'AdminSH' => 'Staff House Admin',
            'AdminDFTC' => 'DFTC Admin',
        ];
        $countClients = Client::count();
        return view('superAdmin.functions.clients.view-clients', [
            'clients' => $clients,
            'countClients' => $countClients,
            'rolesCount' => $rolesCount,
            'roleOptions' => $roleOptions,
        ]);
    }
    public function deactivateClient(Request $request){
        $client = Client::where('id', $request->client_id)->update([
            'status' => 'Inactive',
        ]);
        return !is_null($client) ? 1 : 0;
    }
    public function activateClient(Request $request){
        $client = Client::where('id', $request->client_id)->update([
            'status' => 'Active',
        ]);
        return !is_null($client) ? 1 : 0;

    }
    public function setPermissionClient(Request $request){
        $client = Client::where('id', $request->client_id)->update([
            'role' => $request->set_role,
        ]);
        return !is_null($client) ? 1 : 0;
    }
    public function goToViewAccount(){
        $client_id = session()->get('loggedInSuperAdmin')['id'];
        $clients = Client::where('id', $client_id)->get();
        return view('superAdmin.functions.account.view-account', ['clients' => $clients,]);
    }
    public function goToActivityLogs(){
        $audits = Audit::all();
        $countAudits = Audit::count();
        return view('superAdmin.functions.activity-logs.view-activitylogs', ['audits' => $audits] , compact('countAudits'));
    }
    public function editAccount(Request $request){
        $client_id = session()->get('loggedInSuperAdmin')['id'];
        $client = Client::where('id', $client_id)->first();
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
        } else {
            if (!Hash::check($request->input('old_password'), $client->password)) {
               return 2;
            } else {
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
                $client->update($updateData);
                $clientId = session()->get('loggedInSuperAdmin')['id'];
                $fullname = session()->get('loggedInSuperAdmin')['fullname'];
                $role = session()->get('loggedInSuperAdmin')['role'];
                $activity = "Modified own account in the system.";
                (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
                return !is_null($client) ? 1 : 0;
            }
        }
    }
    public function getRoomDataEditGuestHouse(Request $request) {
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
    public function getRoomDataEditStaffHouse(Request $request) {
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
    public function getRoomDataEditDftcRoom(Request $request) {
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
    public function getRoomDataEditDftcHall(Request $request) {
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
    public function addRoom(Request $request){
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
            $room->save();
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Added a room in the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            return !is_null($room) ? 1 : 0;
        }
    }
    public function updateRoom(Request $request){
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

        $updateResult = Room::where('id', $request->room_id)->update($roomData);
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Modified a room in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return $updateResult ? 1 : 0;
    }
    public function deleteRoom(Request $request){
        $deleteRoom = Room::where('id', $request->room_id)->delete();
        $clientId = session()->get('loggedInSuperAdmin')['id'];
        $fullname = session()->get('loggedInSuperAdmin')['fullname'];
        $role = session()->get('loggedInSuperAdmin')['role'];
        $activity = "Deleted a room in the system.";
        (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
        return !is_null($deleteRoom) ? 1 : 0;
    }
    public function logoutSuperAdmin(){
        if(session()->has('loggedInSuperAdmin')){
            $clientId = session()->get('loggedInSuperAdmin')['id'];
            $fullname = session()->get('loggedInSuperAdmin')['fullname'];
            $role = session()->get('loggedInSuperAdmin')['role'];
            $activity = "Logged out into the system.";
            (new AuditController)->createAuditTrail($fullname ,$clientId, $activity , $role);
            session()->pull('loggedInSuperAdmin');
            return redirect('/');
        }
    }
}
