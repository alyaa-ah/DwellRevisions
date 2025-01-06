@extends('adminDftc/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-16">
                        <a href="{{ url('/adminDFTC/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-rooms') || Request::is('adminDFTC/create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-ongoing-DFTC-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-ongoing-DFTC-pre-reservations') || Request::is('adminDFTC/view-pending-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-DFTC-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-DFTC-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminDFTC/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-rejected-pre-reservations') || Request::is('adminDFTC/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                                    <a href="{{ url('/adminDFTC/view-my-ongoing-DFTC-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminDFTC/view-my-ongoing-staffhouse-pre-reservations') || Request::is('adminDFTC/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span class="ms-1">PRE-BOOKINGS</span>
                                    </a>
                                </li>
                                <li class="border-bottom w-full">
                                    <a href="{{ url('/adminDFTC/view-my-DFTC-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-guesthouse-history') || Request::is('adminDFTC/view-my-staffhouse-history') || Request::is('adminDFTC/view-my-DFTC-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                                        <i class="fas fa-history"></i>
                                        <span class="ms-1">HISTORY</span>
                                    </a>
                                </li>
                                <li class="border-gray-300 w-full">
                                    <a href="{{ url('/adminDFTC/view-my-DFTC-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-rejected-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                        <i class="fas fa-ban"></i>
                                        <span class="ms-1">VOIDS</span>
                                    </a>
                                </li>
                            </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminDFTC/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-9 col-md-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">PRE-BOOKINGS</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-ongoing-DFTC-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-ongoing-DFTC-pre-reservations') }}">Current</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-pending-DFTC-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-pending-DFTC-pre-reservations') }}">Pending</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">CURRENT</p>
            <div class="container card w-12/12 bg-light-white mt-3 mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="dftcBookingTableAdminDftcCurrent">
                            <thead>
                                <th width="15%">Full Name</th>
                                <th width="10%">Room Name</th>
                                <th width="13%">Check In</th>
                                <th width="13%">Check Out</th>
                                <th width="5%">Amount</th>
                                <th width="15%" class="text-center">Remarks</th>
                                <th width="10%" class="text-center">Action Taken</th>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->fullname }}</td>
                                        <td>
                                            @if(strlen($booking->room_number) > 10)
                                                {{ explode(' ', $booking->room_number)[0] }} HALL
                                            @else
                                                {{ $booking->room_number }}
                                            @endif
                                        </td>

                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td class="text-center">{{ $booking->total_amount }}</td>
                                        <td class="status-cell">
                                            @if ($booking->remarks == "Early Check Out")
                                                <span class="status-badge early-checkout">
                                                    <i class="fas fa-arrow-right"></i> {{ $booking->remarks }}
                                                </span>
                                            @elseif (Str::contains($booking->remarks, "Extended"))
                                                <span class="status-badge extended">
                                                    <i class="fas fa-plus-circle"></i> {{ $booking->remarks }}
                                                </span>
                                            @else
                                                @if ($booking->remarks == "" || $booking->remarks == null)
                                                    <span class="status-badge no-remarks">
                                                        <i class="fas fa-info-circle"></i> No Remark
                                                    </span>
                                                @else
                                                    <span class="status-badge default">
                                                        {{ $booking->remarks }}
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" onclick="viewDftcBookingAdminDftc('{{ addslashes(json_encode($booking) )}}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                            @if ($booking->remarks == null || $booking->remarks == '')
                                                <button type="button" onclick="checkDftcBookingAdminDFTC('{{ addslashes(json_encode($booking) )}}')" class="btn btn-warning"><i class="fa-solid fa-edit" style="color: BLACK;"></i></button>
                                            @endif
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
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="fullNameDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="emailDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="contactDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="homeAddressDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="positionDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-1">
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
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="datetimeFilledUpDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="bookingNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p colspan="1" class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="activityDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="roomNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkInDateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkOutDateDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfDaysDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfNightsDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="arrivalDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="departureDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfMalesDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                    <div class="col-md-4 mb-1">
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
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="specialRequestDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="rateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-1">
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
                            <div class="row bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="fullNameDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4">
                                    <p id="emailDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row  bg-gray-100 ">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="contactDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="homeAddressDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="positionDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="agencyDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="datetimeFilledUpDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="bookingNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="activityDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="roomNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkInDateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkOutDateDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfDaysDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfNightsDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="arrivalDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="departureDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfMalesDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfFemalesDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row mb-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="specialRequestDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row mb-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Janitor Services</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="janitorServices-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">AV Services</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="avServices-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="rateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-2">
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
<div class="modal fade" id="checkModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Change Status Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="check-clientbooking-form">
                                <!-- Hidden Booking ID -->
                                <div class="form-group Montserrat text-sm font-semibold" hidden>
                                  <label for="reviewStatus" class="form-group text-light-green">Booking ID</label>
                                  <input type="text" class="form-control" name="booking_id" id="booking_check_id">
                                </div>

                                <!-- Original Checkout Date -->
                                <div class="form-group Montserrat text-sm font-semibold" hidden>
                                    <label for="reviewStatus" class="form-group text-light-green">Original CheckIn Date</label>
                                    <input type="text" class="form-control" id="originalCheckIn" readonly>
                                </div>

                                <div class="form-group Montserrat text-sm font-semibold" hidden>
                                    <label for="reviewStatus" class="form-group text-light-green">Original Checkout Date</label>
                                    <input type="text" class="form-control" id="originalCheckoutDate" readonly>
                                </div>

                                <div class="form-group Montserrat text-sm font-semibold">
                                  <label for="reviewStatus" class="form-group text-light-green">Original Checkout Date</label>
                                  <input type="text" class="form-control" id="originalDate" readonly>
                                </div>

                                <!-- Status Dropdown -->
                                <div class="form-group Montserrat text-sm font-semibold">
                                  <label for="reviewCheck" class="form-group text-light-green">Pre-Booking Status</label>
                                  <select id="reviewCheck" name="remarks" class="form-control" onchange="handleStatusChange()">
                                    <option value="">Select status</option>
                                    <option value="Early Check Out">Early Check Out</option>
                                    <option value="Extended">Extended</option>
                                  </select>
                                </div>

                                <!-- Early Check Out Date -->
                                <div class="form-group Montserrat text-sm font-semibold" id="earlyCheckOutGroup" style="display:none;">
                                  <label for="earlyCheckOutDate" class="form-group text-light-green">Early Check Out Date</label>
                                  <input type="date" name="earlyCheckOutDate" id="earlyCheckOutDate" class="form-control" onchange="updateEarlyCheckOutRemarks()">
                                </div>
                                <input type="text" id="newRemarks" name="newremarks" hidden>
                                <!-- Extended Checkout Date -->
                                <div class="form-group Montserrat text-sm font-semibold" id="extendedCheckOutGroup" style="display:none;">
                                  <label for="extendedCheckOutDate" class="form-group text-light-green">Extended Checkout Date</label>
                                  <input type="date" name="extendedCheckOutDate" id="extendedCheckOutDate" class="form-control" onchange="calculateExtendedDays()">
                                </div>

                                <!-- Submit Button -->
                                <div class="modal-footer">
                                  <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function handleStatusChange() {
      const statusSelect = document.getElementById('reviewCheck').value;
      const earlyCheckOutGroup = document.getElementById('earlyCheckOutGroup');
      const extendedCheckOutGroup = document.getElementById('extendedCheckOutGroup');
      const originalDate = document.getElementById('originalDate').value;

      earlyCheckOutGroup.style.display = "none";
      extendedCheckOutGroup.style.display = "none";

      if (statusSelect === "Early Check Out") {
        earlyCheckOutGroup.style.display = "block";
        document.getElementById('earlyCheckOutDate').value = originalDate;
        setMinCheckOutDate(originalDate);
        setMinEarlyCheckOutDate(originalDate);
      } else if (statusSelect === "Extended") {
        extendedCheckOutGroup.style.display = "block";
        setMinExtendedCheckOutDate(originalDate);
      }
    }


    function setMinCheckOutDate() {
      const checkInDateStr = document.getElementById('originalCheckIn').value;

      if (checkInDateStr) {
        const [day, month, year] = checkInDateStr.split('/');


        const isoFormattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;


        document.getElementById('earlyCheckOutDate').setAttribute('min', isoFormattedDate);
        document.getElementById('extendedCheckOutDate').setAttribute('min', isoFormattedDate);
      }
    }

    function setMinEarlyCheckOutDate() {
    const checkInDateStr = document.getElementById('originalCheckIn').value;
    const checkOutDateStr = document.getElementById('originalCheckoutDate').value;

    if (checkInDateStr && checkOutDateStr) {

        const [checkInDay, checkInMonth, checkInYear] = checkInDateStr.split('/');
        const checkInDate = new Date(checkInYear, checkInMonth - 1, checkInDay);


        const [checkOutDay, checkOutMonth, checkOutYear] = checkOutDateStr.split('/');
        const checkOutDate = new Date(checkOutYear, checkOutMonth - 1, checkOutDay);


        const minDate = `${checkInDate.getFullYear()}-${(checkInDate.getMonth() + 1).toString().padStart(2, '0')}-${checkInDate.getDate().toString().padStart(2, '0')}`;


        checkOutDate.setDate(checkOutDate.getDate() - 1);
        const maxDate = `${checkOutDate.getFullYear()}-${(checkOutDate.getMonth() + 1).toString().padStart(2, '0')}-${checkOutDate.getDate().toString().padStart(2, '0')}`;


        document.getElementById('earlyCheckOutDate').setAttribute('min', minDate);
        document.getElementById('earlyCheckOutDate').setAttribute('max', maxDate);
    }
}


if (statusSelect === "Early Check Out") {
    earlyCheckOutGroup.style.display = "block";
    document.getElementById('earlyCheckOutDate').value = originalDate;
    setMinCheckOutDate(originalDate);
    setMinEarlyCheckOutDate(originalDate);
}

function setMinCheckOutDate(originalDate) {
    const minDate = new Date(originalDate);
    minDate.setDate(minDate.getDate() + 1);

    const formattedMinDate = minDate.toISOString().split('T')[0];
    document.getElementById('earlyCheckOutDate').setAttribute('min', formattedMinDate);
}
function setMinExtendedCheckOutDate(originalDate) {
    const originalCheckoutDate = new Date(originalDate);
    originalCheckoutDate.setDate(originalCheckoutDate.getDate() + 1);
    const minDate = originalCheckoutDate.toISOString().split('T')[0];
    document.getElementById('extendedCheckOutDate').setAttribute('min', minDate);
    document.getElementById('extendedCheckOutDate').value = minDate;
}
window.onload = function() {
    handleStatusChange();
}
    function updateEarlyCheckOutRemarks() {
      const earlyCheckOutDateStr = document.getElementById('earlyCheckOutDate').value;
      if (earlyCheckOutDateStr) {
        const earlyCheckOutDate = new Date(earlyCheckOutDateStr);
        const formattedDate = earlyCheckOutDate.toLocaleDateString('en-US', {
          timeZone: 'Asia/Manila',
          month: 'long',
          day: 'numeric',
          year: 'numeric',
        });

        document.getElementById('newRemarks').value = `Early Check Out`;
      }
    }


    function calculateExtendedDays() {
      const extendedCheckoutDate = document.getElementById('extendedCheckOutDate').value;
      const originalDateInput = document.getElementById('originalDate').value;

      if (!extendedCheckoutDate || !originalDateInput) return;

      const originalDate = new Date(originalDateInput);
      const newDate = new Date(extendedCheckoutDate);

      const diffTime = newDate - originalDate;
      const daysExtended = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

      if (daysExtended > 0) {
        document.getElementById('newRemarks').value = `Extended + ${daysExtended} days`;
      }
    }
</script>
@endsection
