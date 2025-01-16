@extends('superAdmin/layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countRooms <= 2) style="height: 100vh;" @else style="height: auto;" @endif>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-sm-2 px-0 min-h-min" @if($countRooms <= 2) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-5">
                        <a href="{{ url('superAdminDashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdminDashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-rooms') || Request::is('superAdmin/view-create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-preservations') || Request::is('superAdmin/view-staffhouse-preservations') || Request::is('superAdmin/view-DFTC-preservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-history') || Request::is('superAdmin/view-staffhouse-history') || Request::is('superAdmin/view-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ?  'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-clients') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-clients') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="ms-1 d-none d-sm-inline"> CLIENTS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-activity-logs') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-activity-logs') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="ms-1 d-none d-sm-inline">ACTIVITY LOGS</span>
                        </a>
                    </li>
                    <li class="border-b border-gray-300 w-full">
                        <a href="{{ url('/superAdmin/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">ROOMS</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/superAdmin/view-rooms') }}"><i class="fa-solid fa-bed">&nbsp;</i>Rooms</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-create-room') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('superAdmin/view-create-room') }}"><i class="fa-solid fa-circle-plus">&nbsp;</i>Create</a>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 xl:w-full bg-light-white mt-2 px-2">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <div class="row d-flex justify-content-center">
                                <div class="table-responsive">
                                    <table class="table table-responsive responsive table-hover" id="rooms_table">
                                        <thead>
                                            <tr>
                                                <th width="13%">Facility Name</th>
                                                <th width="17%">Name/Number</th>
                                                <th width="20%">Type</th>
                                                <th width="5%">Rate</th>
                                                <th width="5%">Capacity</th>
                                                <th width="15%" class="text-center">Status</th>
                                                <th width="15%" class="text-center">Action Taken</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rooms as $room)
                                            <tr>
                                                <td>{{ $room->facility_name }}</td>
                                                <td>{{ $room->room_number }}</td>
                                                <td>{{ $room->room_type }}</td>
                                                <td>{{ $room->room_rate }}</td>
                                                <td>{{ $room->room_capacity }}</td>
                                                <td class="status-cell">
                                                    @if ($room->room_status == "Available")
                                                        <span class="status-badge available">
                                                            <i class="fas fa-check-circle"></i> Available
                                                        </span>
                                                    @elseif ($room->room_status == "Unavailable")
                                                        <span class="status-badge unavailable">
                                                            <i class="fas fa-times-circle"></i> Unavailable
                                                        </span>
                                                    @elseif ($room->room_status == "Under-Renovation")
                                                        <span class="status-badge on-renovation">
                                                            <i class="fas fa-tools"></i> Under-Renovation
                                                        </span>
                                                    @elseif ($room->room_status == "Occupied")
                                                        <span class="status-badge occupied">
                                                            <i class="fas fa-lock"></i> Occupied
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" onclick="viewRoom('{{ addslashes(json_encode($room)) }}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                                    <button type="button" onclick="editRoom('{{ addslashes(json_encode($room)) }}')" class="btn btn-warning"><i class="fa-solid fa-edit" style="color: black;"></i></button>
                                                    <button type="button" onclick="deleteRoom('{{ addslashes(json_encode($room)) }}')" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: black;"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="update-room-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" >
                <div class="modal-header bg-light-green">
                    <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Update Room</h1>
                    <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="update-room-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4" hidden>
                                            <div class="form-group text-light-green">
                                                <label for="room_id" style="font-weight: bold;">Room ID</label>
                                                <input type="text" name="room_id" id="room_id" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="facility" style="font-weight: bold;">Facility</label>
                                                <select name="facility" id="updateFacility" class="form-control">
                                                    <option value="">Select Facility</option>
                                                        @foreach($facilities as $facility)
                                                            <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_type" style="font-weight: bold;">Room Type</label>
                                                <select name="room_type" id="updateRoomType" class="form-control">
                                                    <option value="">Select Room type</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_number" style="font-weight: bold;">Room Name & Number</label>
                                                <input type="text" class="form-control" name="room_number" id="updateRoomNumber" placeholder="Type here the room number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_rate" style="font-weight: bold;">Room Rate</label>
                                                <input type="number" class="form-control" name="room_rate" id="updateRoomRate" placeholder="Type here the room rate">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_status" style="font-weight: bold;">Room Status</label>
                                                <select name="room_status" id="updateRoomStatus" class="form-control">
                                                    <option value="">Select Room Status</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Under-Renovation">Under-Renovation</option>
                                                    <option value="Occupied">Occupied</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_capacity" style="font-weight: bold;">Room Capacity</label>
                                                <input type="number" class="form-control" name="room_capacity" id="updateRoomCapacity" placeholder="Type here the room capacity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_description" style="font-weight: bold;">Room Description</label>
                                                <textarea name="room_description" id="updateRoomDescription" cols="5" rows="5" class="form-control" placeholder="Type here the room description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_amenities" style="font-weight: bold;">Room Amenities</label>
                                                <textarea name="room_amenities" id="updateRoomAmenities" cols="5" rows="5" class="form-control" placeholder="Type here the room amenities"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_inclusion" style="font-weight: bold;">Room Inlusion</label>
                                                <textarea name="room_inclusion" id="updateRoomInclusion" cols="5" rows="5" class="form-control" placeholder="Type here the room inclusion"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_photo1" style="font-weight: bold;">Room Photo 1</label>
                                                <input type="file" name="room_photo1" id="updateRoomPhoto1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_photo2" style="font-weight: bold;">Room Photo 2</label>
                                                <input type="file" name="room_photo2" id="updateRoomPhoto2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group text-light-green">
                                                <label for="room_photo3" style="font-weight: bold;">Room Photo 3</label>
                                                <input type="file" name="room_photo3" id="updateRoomPhoto3" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Submit</button>
            </div>
        </form>
            </div>
        </div>
    </div>
<div class="modal fade" id="view-room-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">View Room Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container  border-4 rounded-md border-green-600">
                    <div class="row my-2 bg-gray-100">
                        <div class="col-md-12">
                            <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                Room Information
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Facility Name</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="facilityName-modal">Guest House</p>
                        </div>
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Name</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="roomName-modal"></p>
                        </div>
                    </div>
                    <div class="row bg-gray-100">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Type</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="roomType-modal"></p>
                        </div>
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Status</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="roomStatus-modal"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Capacity</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="roomCapacity-modal"></p>
                        </div>
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Rate</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <p id="roomRate-modal"></p>
                        </div>
                    </div>
                    <div class="row bg-gray-100">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Description</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <textarea class="form-control" id="roomDescription-modal" cols="5" rows="5" readonly></textarea>
                        </div>
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Amenities</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <textarea class="form-control" id="roomAmenities-modal" cols="5" rows="5" readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Inclusions</p>
                        </div>
                        <div class="col-md-10 mb-2">
                            <textarea class="form-control" id="roomInclusion-modal" cols="5" rows="5" readonly></textarea>
                        </div>
                    </div>
                    <div class="row bg-gray-100">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Photo 1</p>
                        </div>
                        <div class="col-md-10 mb-2">
                            <img id="roomPhoto1-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                        </div>
                    </div>
                    <div class="row bg-gray-100">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Photo 2</p>
                        </div>
                        <div class="col-md-10 mb-2">
                            <img id="roomPhoto2-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                        </div>
                    </div>
                    <div class="row bg-gray-100">
                        <div class="col-md-2 mb-2">
                            <p class="h6">Room Photo 3</p>
                        </div>
                        <div class="col-md-10 mb-2">
                            <img id="roomPhoto3-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="delete-room-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content" >
                <div class="modal-header bg-light-green">
                    <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Delete Room</h1>
                    <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="delete-room-form">
                                    @csrf
                                    <table class="table table-borderless mx-auto">
                                        <tbody>
                                            <tr hidden>
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group text-light-green">
                                                        <label for="room_id">Room ID</label>
                                                        <input type="text" class="form-control" name="room_id" id="roomId" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="Montserrat text-xl font-semibold">
                                                    <div class="text-light-green text-center">
                                                        Warning! Are you sure you want to delete this booking?
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
document.getElementById('updateFacility').addEventListener('change', function() {
    var roomTypeSelect = document.getElementById('updateRoomType');
    roomTypeSelect.innerHTML = '';

    var selectedFacility = this.options[this.selectedIndex].text;
    var options = [];

    if (selectedFacility === 'DFTC') {
        options = [
            'Dormitory Room 1st Floor',
            'Dormitory Room 2nd Floor',
            'Air Conditioned',
            'Hall'
        ];
    } else if (selectedFacility === 'Guest House') {
        options = [
            'Family/Group Room'
        ];
    } else if (selectedFacility === 'Staff House') {
        options = [
            'Ladies\' Room',
            'Men\'s Room'
        ];
    }

    options.forEach(function(option) {
        var newOption = document.createElement('option');
        newOption.value = option;
        newOption.text = option;
        roomTypeSelect.appendChild(newOption);
    });
});
</script>
@endsection
