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
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">PRE-BOOKINGS</p>
                <div class="container card w-12/12 bg-light-white mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-striped table-hover w-auto" id="guestHouseBookingTableAdminSH">
                                <thead>
                                    <th width="30%">Room Name</th>
                                    <th width="15%">Check In Date</th>
                                    <th width="15%">Check Out Date</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="5%">Amount</th>
                                    <th width="20%" class="text-center">Action Taken</th>
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
                                            <td class="text-center">
                                                <button type="button" onclick="viewGuestHouseBookingAdminSH('{{ addslashes(json_encode($booking) )}}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                                    @if ($booking->status == 'Pending Review')
                                                        <button type="button" onclick="editGuestHouseBookingAdminSH('{{ addslashes(json_encode($booking) )}}')" class="btn btn-warning"><i class="fa-solid fa-edit" style="color: black;"></i></button>
                                                    @else
                                                        <button type="button" onclick="generateAdminSHPdfGuestHouseBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-success"><i class="fa-solid fa-file-pdf" style="color: #000000;"></i></button>
                                                    @endif
                                                <button type="button" onclick="cancelGuestHouseBookingAdminSH('{{ addslashes(json_encode($booking)) }}')" class="btn btn-danger"><i class="fa-solid fa-xmark" style="color: #000000;"></i></i></button>
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


<div class="modal fade" id="view-guesthousebooking-modal" >
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
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="fullNameGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="emailGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="contactGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="homeAddressGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="positionGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="agencyGuestHouse-modal"></p>
                                </div>
                            </div>
                            <!-- Booking Information -->
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Booking Information
                                </div>
                            </div>
                            <div class="row  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="datetimeFilledUpGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6 my-2">Booking Number</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p class="" id="bookingNumberGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p id="activityGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p id="roomNumberGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkInDateGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                <p id="checkOutDateGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfDaysGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                        <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfNightsGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="arrivalGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="departureGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfMalesGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfFemalesGuestHouse-modal"></p>
                                </div>
                            </div>
                             <!-- Optional Preferences -->
                             <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Optional Preferences
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Additional Bedding</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="beddingGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Videoke Rent</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="rentGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p id="specialRequestGuestHouse-modal"></p>
                                </div>
                            </div>
                             <!-- Additional Information -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Additional Information
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Name of Male Guest(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <textarea class="form-control" id="maleGuestHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Name of Female Guest(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <textarea class="form-control" id="femaleGuestHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <!-- Rates and Computation -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="rateGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="totalAmountGuestHouse-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guesthouse booking modal -->
<div class="modal fade" id="edit-guesthousebooking-modal">
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
                            <form id="edit-guestHouse-booking-form">
                                @csrf
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row mx-auto mb-2">
                                        <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                            Personal Information
                                        </div>
                                    </div>
                                    <div class="row hidden">
                                        <div class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="booking_id">Booking ID</label>
                                                <input type="text" class="form-control" name="booking_id" id="editIDGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="fullName">Full Name<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="fullname" id="editFullNameGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label class="text-sm">Position/Designation<span class="text-red-600">*</span></label><br>
                                                <select name="position" id="editPositionGuestHouse" class="form-control"  style="background-color:#d3d3d3;" required>
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
                                                <input type="text" class="form-control" name="email" id="editEmailGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div colspan="col-md-12 mb-2" class="Montserrat text-sm font-semibold" id="editletterInputCell" style="display: none;">
                                            <div id="letterInput" class="form-group text-light-green">
                                                <label for="hasLetter">Please attach the letter approved by the President or the Campus Administrator to avail of free services (exclusive to students only).</label>
                                                <select name="hasLetter" id="edithasLetter" class="form-control">
                                                    <option value="No">No</option>
                                                    <option value="Yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="homeAddress">Home Address<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="address" id="editAddressnGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="agency">Department/Agency/College<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="agency" id="editAgencyGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="contactNumber">Contact Number<span class="text-red-600">*</span></label>
                                                <input type="text" class="form-control" name="contactnumber" id="editContactGuestHouse"  style="background-color:#d3d3d3;" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="activity">Activity<span class="text-red-600">*</span></label>
                                            <textarea type="text" class="form-control" cols=5 rows=5 name="activity" id="editActivityGuestHouse" placeholder="Please enter your activity here." required></textarea>
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
                                        <div class="col-md-4">
                                            <div class="row mb-1">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="room_number">Room Number<span class="text-red-600">*</span></label>
                                                    <select name="room_number" id="editRoomNumberGuestHouse" class="form-control" required>
                                                        <option value="">Select Room</option>
                                                        @foreach ($rooms as $room)
                                                            <option value="{{$room->id}}">{{$room->room_number}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="numberofDays">Number Of Days</label>
                                                    <input type="text" class="form-control" name="numberOfDays" id="editNumofDaysGuestHouse" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                    <label for="numberofNights">Number Of Nights</label>
                                                    <input type="text" class="form-control" name="numberOfNights" id="editNumofNightsGuestHouse" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="checkInDate">Check-In Date<span class="text-red-600">*</span></label>
                                                        <input type="date" class="form-control" name="checkInDate" id="editCheckInDateGuestHouse" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="arrival">Time Arrival<span class="text-red-600">*</span></label>
                                                        <input type="time" class="form-control" name="arrival" id="editArrivalGuestHouse" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="checkOutDate">Check-Out Date<span class="text-red-600">*</span></label>
                                                        <input type="date" class="form-control" name="checkOutDate" id="editCheckOutDateGuestHouse" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="departure">Time Departure<span class="text-red-600">*</span></label>
                                                        <input type="time" class="form-control" name="departure" id="editDepartureGuestHouse" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numOfMale">Number of Male<span class="text-red-600">*</span></label>
                                                        <input type="number" class="form-control" name="numOfMale" placeholder="Type 0 if none." id="editNumOfMaleGuestHouse" value="0"  required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                        <label for="numOfFemale">Number of Female<span class="text-red-600">*</span></label>
                                                        <input type="number" class="form-control" name="numOfFemale" placeholder="Type 0 if none." id="editNumOfFemaleGuestHouse" value="0"  required>
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
                                                <input type="text" class="form-control" name="rate" id="editRateGuestHouse" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="capacity">Room Bed Capacity</label>
                                                <input type="text" class="form-control" name="capacity" id="editCapacityGuestHouse" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="totalAmount" class="text-sm">Total Amount</label><br>
                                                <input type="text" class="form-control" name="totalAmount" id="editTotalAmountGuestHouse" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row mb-2">
                                        <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                            Optional Preferences
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat font-semibold text-light-green">
                                                        <label for="bedding" class="text-sm">Additional Bedding<span class="">(100 pesos per bedding)</span></label><br>
                                                        <input type="text" class="form-control" name="bedding" id="editBeddingGuestHouse" value="0" placeholder="Note: Optional, you can leave it blank else, you can enter here your new additional bedding.">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat font-semibold text-light-green">
                                                        <label for="rent" class="text-sm">Videoke (Rent)</label><br>
                                                        <select name="rent" id="editRentGuestHouse" class="form-control">
                                                            <option value="">No</option>
                                                            <option value="500">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                                    Additional Information
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat  text-sm font-semibold text-light-green">
                                                        <label for="maleGuests">Name of Guest/s (Male)</label>
                                                        <textarea name="maleGuests" id="editMaleGuestHouse" cols="5" rows="5" class="form-control" placeholder="Note: For every name, please include a comma in between and enter the name(s) of male guest(s), including yourself if necessary." disabled></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-group Montserrat  text-sm font-semibold text-light-green">
                                                        <label for="femaleGuests">Name of Guest/s (Female)</label>
                                                        <textarea name="femaleGuests" id="editFemaleGuestHouse" cols="5" rows="5" class="form-control" placeholder="Note: For every name, please include a comma in between and enter the name(s) of female guest(s), including yourself if necessary." disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-group Montserrat font-semibold text-light-green">
                                                <label for="specialRequests">Special Requests</label>
                                                <textarea class="form-control"  name="specialRequests" id="editSpecialRequestGuestHouse" placeholder="Note: Optional, you can leave it blank else, you can enter here your request." cols="5" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-end">
                                    <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green w-fit mr-2" data-bs-toggle="modal" data-bs-target="#guestHouseTerms">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel-guesthousebooking-modal">
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
                            <form id="cancel-guesthouse-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Booking ID</label>
                                                    <input type="text" class="form-control" name="booking_id" id="GH_bookingID" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="reason">Reason</label>
                                                    <select name="reason" id="reason" class="form-control">
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
                        </div></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-lg fade" id="guestHouseTerms" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header bg-light-green">
              <h1 class="modal-title Montserrat text-white font-semibold fs-5">REQUEST FOR ACCOMMODATION</h1>
              <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modalBodyEditPreBookGuestHouse" style="max-height: 400px; overflow-y: auto;">
              <p class="Montserrat text-md font-bold font">CONTRACT AND GUIDELINES FOR LODGING AT THE GUEST HOUSE</p>
              <p class="Montserrat text-sm font-semibold text-justify">1. Request for accommodation at the Guest House shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">2. The cleanliness and orderliness of the room/s before and after use shall be observed by the contracting party/group concerned.</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">3. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE GUEST HOUSE. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">4. Any Guest House property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party.</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">5. The guest/s is/are requested to observe hte house rules especially the <b>curfew hour of 10:00 in the evening.</b></p><br>
              <p class="Montserrat text-sm font-semibold text-justify">6. Only registered guest/s is/are allowed to use the facilities including telephone, comfort rooms, and other fixtures of the Guest House. Visitor/s of guest/s is/are not allowed to enter the room of said guest/s.</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">7. The use of cooking equipment and materials shall be requested before use. The charge is P150.00 per day per room</p><br>
              <p class="Montserrat text-sm font-semibold text-justify">8. Loss of personal belongings shall not be the responsibility of the University</p>
          </div>
          <div class="modal-footer bg-light-green">
              <div class="container">
                  <div class="row">
                        <div class="col">
                            <div class="form-group" id="checkboxContainerEditPreBookGuestHouse" style="display: none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultEditGuestHouse">
                                    <label class="form-check-label text-white Montserrat text-sm font-semibold" for="flexCheckDefaultEditGuestHouse" style="margin-left: 0;">
                                        I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                                    </label>
                                </div>
                        </div>
                      </div>
                  </div>
              </div>
              <div>
                  <button type="button" class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                  <button type="button" id="submitButtonEditGuestHouse" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
              </div>
          </div>
      </div>
    </div>
  </div>
<script>
    document.getElementById('modalBodyEditPreBookGuestHouse').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

        if (Math.ceil(this.scrollTop) >= scrollable - 10) {
            document.getElementById('checkboxContainerEditPreBookGuestHouse').style.display = 'block';
        }
    });
    document.getElementById('editNumOfMaleGuestHouse').addEventListener('input', function() {
        var maleGuestField = document.getElementById('editMaleGuestHouse');
        maleGuestField.disabled = this.value <= 0;
    });

    document.getElementById('editNumOfFemaleGuestHouse').addEventListener('input', function() {
        var femaleGuestField = document.getElementById('editFemaleGuestHouse');
        femaleGuestField.disabled = this.value <= 0;
    });
</script>
@endsection
