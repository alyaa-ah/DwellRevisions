@extends('adminSH/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
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
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">MY ACTIVITIES</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center mt-2">
                        <!-- Buttons for medium and larger screens -->
                    <div class="button-group d-none d-md-flex">
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-my-ongoing-guesthouse-pre-reservations') }}">Guest House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-my-ongoing-staffhouse-pre-reservations') }}">Staff House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-my-ongoing-DFTC-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-my-ongoing-DFTC-pre-reservations') }}">DFTC</a>
                    </div>
                 </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mt-2">
                    <!-- Buttons for small screens -->
                    <div class="select-group d-md-none">
                        <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:my-2 sm:w-full md:w-auto" onchange="location = this.value;">
                            <option class="{{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-my-ongoing-guesthouse-pre-reservations') }}" {{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations*') ? 'selected' : '' }}>Guest House</option>
                            <option class="{{ Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-my-ongoing-staffhouse-pre-reservations') }}" {{ Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations*') ? 'selected' : '' }}>Staff House</option>
                            <option class="{{ Request::is('adminSH/view-my-ongoing-DFTC-pre-reservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminSH/view-my-ongoing-DFTC-pre-reservations') }}" {{ Request::is('adminSH/view-my-ongoing-DFTC-pre-reservations*') ? 'selected' : '' }}>DFTC</option>
                        </select>
                    </div>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">PRE-BOOKINGS</p>
            <div class="container card w-12/12 bg-light-white mt-2 mb-2">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="dftcBookingTableAdminSH">
                            <thead>
                                <th width="30%">Room Name</th>
                                <th width="15%">Check In Date</th>
                                <th width="15%">Check Out Date</th>
                                <th width="15%" class="text-center">Status</th>
                                <th width="5%">Amount</th>
                                <th width="20%" class="text-center">Action Taken</th>
                                <th>DFTC DATE</th>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->room_number}}</td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td class="status-cell">
                                            @if ($booking->status == 'Pending Review')
                                                <span class="status-badge pending">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @else
                                                <span class="status-badge approved">
                                                    <i class="fas fa-check-circle"></i> Approved
                                                </span>
                                            @endif
                                        </td>
                                        @if ($booking->total_amount == "0.00" && $booking->position == "Student")
                                            <td>FREE</td>
                                        @else
                                            <td>{{ $booking->total_amount }}</td>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                            @if ($booking->room_type == "Hall")
                                                <button type="button" onclick="viewAdminSHDftcHallBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;" title="View Button for hall"></i></button>
                                                @if ($booking->status == "Pending Review")
                                                    <button type="button" onclick="editAdminSHDftcHallBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-warning"><i class="fa-solid fa-edit" style="color: black;" title="Edit Button for hall"></i></button>
                                                @endif
                                            @else
                                                <button type="button" onclick="viewAdminSHDftcRoomBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;" title="View Button for room"></i></button>
                                                @if ($booking->status == "Pending Review")
                                                    <button type="button" onclick="editAdminSHDftcRoomBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-warning"><i class="fa-solid fa-edit" style="color: black;" title="Edit Button for room"></i></button>
                                                @endif
                                            @endif
                                            @if ($booking->status == 'Pending Review')
                                            @else
                                                <button type="button" onclick="generateAdminSHPdfDftcBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-success"><i class="fa-solid fa-file-pdf" style="color: #000000;"></i></button>
                                            @endif
                                        <button type="button" onclick="cancelAdminSHDftcBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-danger"><i class="fa-solid fa-xmark" style="color: #000000;"></i></i></button>
                                    </td>
                                    <td style="display:none;">{{ $booking->DFTC_date }}</td>
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

<div class="modal fade" id="edit-dftcroombooking-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Modify Pre-Reservation</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="edit-dftcroom-booking-form">
                                @csrf
                                <div class="container mx-auto mt-2">
                                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                        <div class="row">
                                            <div class="col-md-12 text-center mb-2">
                                                <h4 class="Montserrat text-xl font-semibold text-light-green">Personal Information</h4>
                                            </div>
                                        </div>
                                        <div class="row" hidden>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="booking_id">Booking ID</label>
                                                    <input type="text" class="form-control" name="booking_id" id="editIdDftcRoom" style="background-color:#d3d3d3;" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="fullName">Full Name<span class="text-red-600">*</span></label>
                                                    <input type="text" class="form-control" name="fullname" id="editFullNameDftcRoom"style="background-color:#d3d3d3;" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat font-semibold text-light-green">
                                                    <label class="text-sm">Position/Designation<span class="text-red-600">*</span></label><br>
                                                    <select name="position" id="editPositionDftcRoom" class="form-control " style="background-color:#d3d3d3;" required>
                                                        <option value="">Select Position/Designation</option>
                                                        <option value="Guest">Guest</option>
                                                        <option value="Student">Student</option>
                                                        <option value="Employee">Employee</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group Montserrat font-semibold text-light-green">
                                                        <label for="Email">Email Address<span class="text-red-600">*</span></label>
                                                        <input type="text" class="form-control" name="email" id="editEmailDftcRoom" style="background-color:#d3d3d3;" readonly required>
                                                    </div>
                                                </td>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="homeAddress">Home Address<span class="text-red-600">*</span></label>
                                                    <input type="text" class="form-control" name="address" id="editAddressDftcRoom" style="background-color:#d3d3d3;" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="agency">Department/Agency/College<span class="text-red-600">*</span></label>
                                                    <input type="text" class="form-control" name="agency" id="editAgencyDftcRoom" style="background-color:#d3d3d3;" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="contactNumber">Contact Number<span class="text-red-600">*</span></label>
                                                    <input type="text" class="form-control" name="contactnumber" id="editContactDftcRoom" style="background-color:#d3d3d3;" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="Montserrat text-sm font-semibold" id="editletterInputCellDftcRoom" style="display: none;">
                                                <div id="letterInput" class="form-group text-light-green">
                                                    <label for="hasLetter">Please attach the letter approved by the President or the Campus Administrator to avail of free services (exclusive to students only).</label>
                                                    <select name="hasLetter" id="editHasLetterDftcRoom" class="form-control">
                                                        <option value="No">No</option>
                                                        <option value="Yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="activity">Activity<span class="text-red-600">*</span></label>
                                                    <textarea type="text" class="form-control" cols=5 rows=5 name="activity" id="editActivityDftcRoom" placeholder="Enter here your new activity." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                        <div class="row">
                                            <div class="col-md-12 text-center mb-2">
                                                <h4 class="Montserrat text-xl font-semibold text-light-green">Duration of Stay</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green mb-1">
                                                    <label for="room_number">Room Number<span class="text-red-600">*</span></label>
                                                    <select name="room_number" id="editRoomNumberDftcRoom" class="form-control" required>
                                                        <option value="">Select Room</option>
                                                        @foreach ($rooms as $room)
                                                            @if ($room->room_type != "Hall")
                                                                <option value="{{$room->id}}">{{$room->room_number}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numberofDays">Number Of Days</label>
                                                        <input type="text" class="form-control" name="numberOfDays" id="editNumOfDaysDftcRoom" placeholder="0" style="background-color:#d3d3d3;" readonly required>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numberofNights">Number Of Nights</label>
                                                        <input type="text" class="form-control" name="numberOfNights" id="editNumOffNightsDftcRoom" placeholder="0" style="background-color:#d3d3d3;" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="checkInDate">Check-In Date<span class="text-red-600">*</span></label>
                                                            <input type="date" class="form-control" name="checkInDate" id="editCheckInDateDftcRoom" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="arrival">Time Arrival<span class="text-red-600">*</span></label>
                                                            <input type="time" class="form-control" name="arrival" id="editArrivalDftcRoom" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="checkOutDate">Check-Out Date<span class="text-red-600">*</span></label>
                                                            <input type="date" class="form-control" name="checkOutDate" id="editCheckOutDateDftcRoom" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="departure">Time Departure<span class="text-red-600">*</span></label>
                                                            <input type="time" class="form-control" name="departure" id="editDepartureDftcRoom" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="numOfMale">Number of Male<span class="text-red-600">*</span></label>
                                                            <input type="number" class="form-control" name="numOfMale" id="editNumOfMaleDftcRoom" placeholder="Type 0 if none." value="0" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                            <label for="numOfFemale">Number of Female<span class="text-red-600">*</span></label>
                                                            <input type="number" class="form-control" name="numOfFemale" id="editNumOfFemaleDftcRoom" placeholder="Type 0 if none." value="0" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                        <div class="row">
                                            <div class="col-md-12 text-center mb-2">
                                                <h4 class="Montserrat text-xl font-semibold text-light-green"> Rates and Computation</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="rate">Rate</label>
                                                    <input type="text" class="form-control" name="rate" id="editRateDftcRoom" placeholder="0.00" style="background-color:#d3d3d3;"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="capacity">Room Bed Capacity</label>
                                                    <input type="text" class="form-control" name="capacity" id="editCapacityDftcRoom" placeholder="0" value="0" style="background-color:#d3d3d3;"  readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="totalAmount" class="text-sm">Total Amount</label><br>
                                                    <input type="text" class="form-control" name="totalAmount" id="editTotalAmountDftcRoom" placeholder="0.00" value="0" style="background-color:#d3d3d3;"  readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                        <div class="row">
                                            <div class="col-md-12 text-center mb-2">
                                                <h4 class="Montserrat text-xl font-semibold text-light-green"> Optional Preferences</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group Montserrat font-semibold text-light-green">
                                                    <label for="specialRequests">Special Requests</label>
                                                    <textarea class="form-control"  name="specialRequests" id="editSpecialRequestDftcRoom" cols="5" rows="5" placeholder="Note: Optional, you can leave it blank else you can enter here you new special request."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-end">
                                        <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green w-fit mr-2" data-bs-toggle="modal" data-bs-target="#dftcTermsEditDftcRoom">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-dftchallbooking-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Modify Pre-Reservation</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="edit-dftchall-booking-form">
                                @csrf
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row mx-auto mb-2">
                                        <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                            Personal Information
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="booking_id">Booking ID</label>
                                            <input type="text" class="form-control" name="booking_id" id="editIdDftcHall" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="fullName">Full Name<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="fullname" id="editFullNameDftcHall" style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat font-semibold text-light-green">
                                                <label class="text-sm">Position/Designation<span class="text-red-600">*</span></label><br>
                                                <select name="position" id="editPositionDftcHall" class="form-control readonly-select" style="background-color:#d3d3d3;" required>
                                                    <option value="">Select Position/Designation</option>
                                                    <option value="Guest">Guest</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Employee">Employee</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="Email">Email Address<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="email" id="editEmailDftcHall" style="background-color:#d3d3d3;"  readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="homeAddress">Home Address<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="address" id="editAddressDftcHall" style="background-color:#d3d3d3;"  readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="agency">Department/Agency/College<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="agency" id="editAgencyDftcHall" style="background-color:#d3d3d3;"  readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="contactNumber">Contact Number<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="contactnumber" id="editContactDftcHall" style="background-color:#d3d3d3;"  readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="Montserrat text-sm font-semibold" id="editLetterInputCellDftcHall" style="display: none;">
                                                <div id="letterInput" class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="hasLetter">Please attach the letter approved by the President or the Campus Administrator to avail of free services (exclusive to students only).</label>
                                                    <select name="hasLetter" id="editHasLetterDftcHall" class="form-control">
                                                        <option value="No">No</option>
                                                        <option value="Yes">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="activity">Activity<span class="text-red-600">*</span></label>
                                                <textarea type="text" class="form-control" cols=5 rows=5 name="activity" id="editActivityDftcHall" placeholder="Enter here your new activity." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row mb-2">
                                        <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                                        Duration of Stay
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green mb-1">
                                                <label for="room_number">Room Number<span class="text-red-600">*</span></label>
                                                <select name="room_number" id="editRoomNumberDftcHall" class="form-control"  required>
                                                    <option value="">Select Room</option>
                                                        @foreach($rooms as $room)
                                                            @if($room->room_type == "Hall")
                                                                <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                                            @endif
                                                        @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="numberofDays">Number Of Days</label>
                                                    <input type="text" class="form-control" name="numberOfDays" id="editNumOfDaysDftcHall" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="numberofNights">Number Of Nights</label>
                                                    <input type="text" class="form-control" name="numberOfNights" id="editNumOfNightsDftcHall" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="checkInDate">Check-In Date<span class="text-red-600">*</span></label>
                                                        <input type="date" class="form-control" name="checkInDate" id="editCheckInDateDftcHall" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="arrival">Time Arrival<span class="text-red-600">*</span></label>
                                                        <input type="time" class="form-control" name="arrival" id="editArrivalDftcHall" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="checkOutDate">Check-Out Date<span class="text-red-600">*</span></label>
                                                        <input type="date" class="form-control" name="checkOutDate" id="editCheckOutDateDftcHall" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="departure">Time Departure<span class="text-red-600">*</span></label>
                                                        <input type="time" class="form-control" name="departure" id="editDepartureDftcHall" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numOfMale">Number of Male<span class="text-red-600">*</span></label>
                                                        <input type="number" class="form-control" name="numOfMale" id="editNumOfMalesDftcHall" placeholder="Enter here the estimated number of male guest." value="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numOfFemale">Number of Female<span class="text-red-600">*</span></label>
                                                        <input type="number" class="form-control" name="numOfFemale" id="editNumOfFemaleDftcHall" placeholder="Enter here the estimated number of female guest." value="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row mb-2">
                                        <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                            Rates and Computation
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="rate">Rate</label>
                                                <input type="text" class="form-control" name="rate" id="editRateDftcHall" style="background-color:#d3d3d3;"style="background-color:#d3d3d3;"  placeholder="0.00" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="capacity">Max Capacity</label>
                                                <input type="text" class="form-control" name="capacity" id="editCapacityDftcHall" style="background-color:#d3d3d3;"style="background-color:#d3d3d3;"  placeholder="0" readonly >
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="totalAmount" class="text-sm">Total Amount</label><br>
                                                <input type="text" class="form-control" name="totalAmount" id="editTotalAmountDftcHall" style="background-color:#d3d3d3;"style="background-color:#d3d3d3;"  placeholder="0.00" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="row">
                                                <div class="col-md-12 mb-2 text-center">
                                                    <div class="Montserrat text-xl font-semibold text-light-green">
                                                        Optional Preferences
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="specialRequests">Special Requests</label>
                                                        <textarea class="form-control"  name="specialRequests" id="editSpecialRequestDftcHall" cols="5" rows="5" placeholder="Note: Optional, you can leave it blank else you can enter here your new special request."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 mb-2">
                                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                                    Additional Charges
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-md-6 md-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="janitorservices">Janitorial Services</label>
                                                        <input type="number" name="janitorservices" id="editJanitorialServicesDftcHall" class="form-control" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="avservices">AV Services</label>
                                                        <input type="number" name="avservices" id="editAvServicesDftcHall" class="form-control" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold  text- text-light-green mt-4">
                                                        <label for="extracharge">Exceed 8 hrs Extra Charge</label>
                                                        <input type="number" name="extracharge" id="extrachargeEditDftcHall" class="form-control" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green mt-4">
                                                        <label for="timerate">Night Time Rate</label>
                                                        <input type="number" name="timerate" id="editTimeRateDftcHall" class="form-control" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 justify-end">
                                    <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green w-fit mr-2" data-bs-toggle="modal" data-bs-target="#dftcTermsEditDftcHall">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="view-DftcHall-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Pre-Reservation Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="border-4 rounded-md border-green-600">
                            <!-- Account Information -->
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="fullNameDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="emailDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row  bg-gray-100 ">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="contactDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="homeAddressDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="positionDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="agencyDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="datetimeFilledUpDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="bookingNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="activityDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="roomNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkInDateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkOutDateDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfDaysDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfNightsDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="arrivalDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="departureDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfMalesDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfFemalesDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row my-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center my-2">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="specialRequestDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row my-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Janitor Services</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="janitorServices-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">AV Services</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="avServices-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="rateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="totalAmountDftcHall-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-DftcRoom-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Pre-Reservation Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 border-4 rounded-md border-green-600">
                            <!-- Account Information -->
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="fullNameDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="emailDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="contactDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="homeAddressDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="positionDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="agencyDftcRoom-modal"></p>
                                </div>
                            </div>
                            <!-- Booking Information -->
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="datetimeFilledUpDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="bookingNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p colspan="1" class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="activityDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="roomNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkInDateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkOutDateDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfDaysDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfNightsDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="arrivalDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="departureDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfMalesDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                    <div class="col-md-4 my-2">
                                <p id="numOfFemalesDftcRoom-modal"></p>
                                </div>
                            </div>
                            <!-- Optional Preferences -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                        Optional Preferences
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="specialRequestDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="rateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="totalAmountDftcRoom-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cancel-dftcbooking-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Cancellation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="cancel-dftc-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Booking ID</label>
                                                    <input type="text" class="form-control" name="booking_id" id="DFTC_bookingID" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="reason">Reason</label>
                                                    <select name="reason" id="reasonDftc" class="form-control">
                                                        <option value="I've changed my mind.">I've changed my mind</option>
                                                        <option value="No longer needed.">No longer needed</option>
                                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                                        <option value="Event rescheduled.">Event rescheduled</option>
                                                        <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                        <option value="Event canceled.">Event canceled</option>
                                                        <option value="Family emergency.">Family emergency</option>
                                                        <option value="Double pre-reservation.">Double pre-reservation</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Warning! Are you sure you want to cancel this pre-reservation?
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel-dftcbooking-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Cancellation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="cancel-dftc-form">
                                    @csrf
                                    <table class="table table-borderless mx-auto">
                                        <tbody>
                                            <tr hidden>
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group text-light-green">
                                                        <label for="room_id">Booking ID</label>
                                                        <input type="text" class="form-control" name="booking_id" id="DFTC_bookingID" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group text-light-green">
                                                        <label for="reason">Reason</label>
                                                        <select name="reason" id="reasonDftc" class="form-control">
                                                            <option value="I've changed my mind.">I've changed my mind</option>
                                                            <option value="No longer needed.">No longer needed</option>
                                                            <option value="Conflict of schedule.">Conflict of schedule</option>
                                                            <option value="Event rescheduled.">Event rescheduled</option>
                                                            <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                            <option value="Event canceled.">Event canceled</option>
                                                            <option value="Family emergency.">Family emergency</option>
                                                            <option value="Double pre-reservation.">Double pre-reservation</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="Montserrat text-xl font-semibold">
                                                    <div class="text-light-green text-center">
                                                        Warning! Are you sure you want to cancel this pre-reservation?
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>

                                    </table>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-lg fade" id="dftcTermsEditDftcRoom" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">
                    <span class="hidden md:inline"> DUMLAO FARMERS' TRAINING CENTER</span>
                    <span class="inline md:hidden">DFTC</span> USE REQUEST
                </h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyEditDftcRoom" style="max-height: 400px; overflow-y: auto;">
                <p class="Montserrat text-md font-bold font">TERMS AND CONDITION OF PAYMENT</p>
                <p class="Montserrat text-sm font-semibold">Payables should be settled on or before departure date and directly yo the Cashier's Office. (With order of payment to be secured at the Auxiliary Services Office)</p><br>
                <p class="Montserrat text-md font-bold font">CONTRACT AND GUIDELINES FOR THE USAGE OF FACILITIES OF THE DUMLAO FARMERS' TRAINING CENTER</p>
                <p class="Montserrat text-sm font-semibold text-justify">1. Request for use of any of the facilities of the Training Center shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">2. For outside sponsored activity, the requesting party should pay at least 50% of the total amount of the requested hall as down payment and the remaining 50% shall be paid on or before the activity date at the Cashier's Office before the approval of the ASP Director. For lodging purposes, payment can be made before or after the accommodation. Payment shall be billed by the Project-in-Charge and paid at the Cashiers Office.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">3. For maximum use of the services, a request for the cancellation of postponement of any sponsored activity shall be allowed without fine; provided that such request for cancellation shall be filed 3 days before the said activity. Violation of this clause shall result to forfeiture.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">4. The cleanliness and orderliness of the facilities before and after use shall be observed by the contracting party/group concerned.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">5. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE CENTER. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">6. Any DFTC property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party. The University shall not be liable for loss of personal properties.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">7. The presence of the University Food Services is a pre-requisite in any instances to cater the food requirements of the contracting party. Outside caterers shall not be allowed to provide meals for any occasion participants unless prior arrangements were made with the Office of the Auxiliary Services Program and shall pay CORKAGE FEE of P500.00 for less than 50 participants, P750.00 for less than 100 participants, and P1,000.00 for more than 100 participants per day.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">8. This <b>CONTRACT APPLIES</b> for the use of the <b>DUMLAO FARMERS' TRAINING CENTER ONLY.</b></p>
            </div>
            <div class="modal-footer bg-light-green">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mr-1" id="checkboxContainerEditDftcRoom" style="display:none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultEditDftcRoom">
                                    <label class="form-check-label text-white Montserrat text-sm font-semibold" for="flexCheckDefaultEditDftcRoom" style="margin-left: 0;">
                                        I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button"  class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitButtonEditDftcRoom" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-lg fade" id="dftcTermsEditDftcHall" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">
                    <span class="hidden md:inline"> DUMLAO FARMERS' TRAINING CENTER</span>
                    <span class="inline md:hidden">DFTC</span> USE REQUEST
                </h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyEditDftcHall" style="max-height: 400px; overflow-y: auto;">
                <p class="Montserrat text-md font-bold font">TERMS AND CONDITION OF PAYMENT</p>
                <p class="Montserrat text-sm font-semibold">Payables should be settled on or before departure date and directly yo the Cashier's Office. (With order of payment to be secured at the Auxiliary Services Office)</p><br>
                <p class="Montserrat text-md font-bold font">CONTRACT AND GUIDELINES FOR THE USAGE OF FACILITIES OF THE DUMLAO FARMERS' TRAINING CENTER</p>
                <p class="Montserrat text-sm font-semibold text-justify">1. Request for use of any of the facilities of the Training Center shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">2. For outside sponsored activity, the requesting party should pay at least 50% of the total amount of the requested hall as down payment and the remaining 50% shall be paid on or before the activity date at the Cashier's Office before the approval of the ASP Director. For lodging purposes, payment can be made before or after the accommodation. Payment shall be billed by the Project-in-Charge and paid at the Cashiers Office.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">3. For maximum use of the services, a request for the cancellation of postponement of any sponsored activity shall be allowed without fine; provided that such request for cancellation shall be filed 3 days before the said activity. Violation of this clause shall result to forfeiture.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">4. The cleanliness and orderliness of the facilities before and after use shall be observed by the contracting party/group concerned.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">5. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE CENTER. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">6. Any DFTC property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party. The University shall not be liable for loss of personal properties.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">7. The presence of the University Food Services is a pre-requisite in any instances to cater the food requirements of the contracting party. Outside caterers shall not be allowed to provide meals for any occasion participants unless prior arrangements were made with the Office of the Auxiliary Services Program and shall pay CORKAGE FEE of P500.00 for less than 50 participants, P750.00 for less than 100 participants, and P1,000.00 for more than 100 participants per day.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">8. This <b>CONTRACT APPLIES</b> for the use of the <b>DUMLAO FARMERS' TRAINING CENTER ONLY.</b></p>
            </div>
            <div class="modal-footer bg-light-green">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mr-1" id="checkboxContainerEditDftcHall" style="display:none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultEditDftcHall">
                                    <label class="form-check-label text-white Montserrat text-sm font-semibold" for="flexCheckDefault" style="margin-left: 0;">
                                        I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button"  class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitButtonEditDftcHall" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        document.getElementById('modalBodyEditDftcRoom').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

        if (Math.ceil(this.scrollTop) >= scrollable - 10) {
            document.getElementById('checkboxContainerEditDftcRoom').style.display = 'block';
        }
    });
    </script>
    <script>
        document.getElementById('modalBodyEditDftcHall').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

            if (Math.ceil(this.scrollTop) >= scrollable - 10) {
                document.getElementById('checkboxContainerEditDftcHall').style.display = 'block';
            }
        });
    </script>
    @endsection
