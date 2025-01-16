@extends('adminSH/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-5">
                        <a href="{{ url('/adminSH/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rooms') || Request::is('adminSH/create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-ongoing-staffhouse-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-ongoing-staffhouse-pre-reservations') || Request::is('adminSH/view-pending-staffhouse-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-staffhouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-staffhouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rejected-pre-reservations') || Request::is('adminSH/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="#" class="dropdown-toggle nav-link text-white" id="myActivities" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tasks fa-fw me-sm-1 fa-md"></i>
                            <span class="d-none d-sm-inline me-sm-1">MY ACTIVITIES</span>
                        </a>
                        <ul class="dropdown-menu bg-dark-green text-dark-white"  aria-labelledby="myActivities">
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminSH/view-my-ongoing-staffhouse-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations') || Request::is('/adminSH/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="ms-1">PRE-BOOKINGS</span>
                                </a>
                            </li>
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-history') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-guesthouse-history') || Request::is('adminSH/view-my-staffhouse-history') || Request::is('adminSH/view-my-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-history"></i>
                                    <span class="ms-1">HISTORY</span>
                                </a>
                            </li>
                            <li class="border-gray-300 w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-canceled-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('/adminSH/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminSH/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-rejected-pre-reservations') || Request::is('adminSH/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminSH/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">VOIDS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminSH/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-9 col-md-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">CREATE</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-rooms') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-rooms') }}"><i class="fa-solid fa-bed">&nbsp;</i>Rooms</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/create-room') ? 'bg-light-green text-dark-white' : 'inactive' }} flex items-center" href="{{ url('/adminSH/create-room') }}" ><i class="fa-solid fa-circle-plus">&nbsp;</i>Create</a>
                </div>
            </div>

            <div class="container card  w-12/12 bg-light-white mt-2">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <p class="h3 text-light-green text-center Montserrat text-xl font-semibold mb-3 mt-3">Room Information</p>
                        <form id="addRoom-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="facility" style="font-weight: bold;">Facility</label>
                                        <select name="facility" id="facility" class="form-control">
                                            <option value="">Select Facility</option>
                                                @foreach($facilities as $facility)
                                                    @if ($facility->facility_name == 'Staff House')
                                                        <option value="{{ $facility->id }}">{{ $facility->facility_name }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_type" style="font-weight: bold;">Room Type</label>
                                        <select name="room_type" id="room_type" class="form-control">
                                            <option value="">Select Room type</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_number" style="font-weight: bold;">Room Name & Number</label>
                                        <input type="text" class="form-control" name="room_number" id="room_number" placeholder="Type here the room number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_rate" style="font-weight: bold;">Room Rate</label>
                                        <input type="number" class="form-control" name="room_rate" id="room_rate" placeholder="Type here the room rate">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_status" style="font-weight: bold;">Room Status</label>
                                        <select name="room_status" id="room_status" class="form-control">
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
                                        <input type="number" class="form-control" name="room_capacity" id="room_capacity" placeholder="Type here the room capacity">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_description" style="font-weight: bold;">Room Description</label>
                                        <textarea name="room_description" id="room_description" cols="5" rows="5" class="form-control" placeholder="Type the room description here. If there is no description, type None"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_amenities" style="font-weight: bold;">Room Amenities</label>
                                        <textarea name="room_amenities" id="room_amenities" cols="5" rows="5" class="form-control" placeholder="Type your amenities here. If there are multiple amenities, separate them with commas. If there are no amenities, type None"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_inclusion" style="font-weight: bold;">Room Inlusion</label>
                                        <textarea name="room_inclusion" id="room_inclusion" cols="5" rows="5" class="form-control" placeholder="Type the room inclusion here. If there is no inclusion, type None"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_photo1" style="font-weight: bold;">Room Photo 1</label>
                                        <input type="file" name="room_photo1" id="room_photo1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_photo2" style="font-weight: bold;">Room Photo 2</label>
                                        <input type="file" name="room_photo2" id="room_photo2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group text-light-green">
                                        <label for="room_photo3" style="font-weight: bold;">Room Photo 3</label>
                                        <input type="file" name="room_photo3" id="room_photo3" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Add Room</button>
                                <button type="reset" class="btn bg-danger text-light ml-3">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('facility').addEventListener('change', function() {
    var roomTypeSelect = document.getElementById('room_type');

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
