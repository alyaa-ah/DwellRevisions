@extends('superAdmin.layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center"@if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-sm-2 px-0 min-h-min"  @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
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
        <!--Main  Content -->
        <div class="col-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">HISTORY</p>
            <div class="row justify-content-center">
                    <div class="col-md-12 d-flex justify-content-center mt-2">
                        <!-- Buttons for medium and larger screens -->
                        <div class="button-group d-none d-md-flex ">
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-guesthouse-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-guesthouse-history') }}">Guest House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-staffhouse-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-staffhouse-history') }}">Staff House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-DFTC-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-DFTC-history') }}">DFTC</a>
                        </div>
                    </div>  
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-2">
                    <!-- Buttons for small screens -->
                        <div class="select-group d-md-none">
                        <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:my-2 sm:w-full md:w-auto" onchange="location = this.value;">
                                <option class="{{ Request::is('superAdmin/view-guesthouse-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-guesthouse-history') }}" {{ Request::is('superAdmin/view-guesthouse-history') ? 'selected' : '' }}>Guest House</option>
                                <option class="{{ Request::is('superAdmin/view-staffhouse-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-staffhouse-history') }}" {{ Request::is('superAdmin/view-staffhouse-history') ? 'selected' : '' }}>Staff House</option>
                                <option class="{{ Request::is('superAdmin/view-DFTC-history') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-DFTC-history') }}" {{ Request::is('superAdmin/view-DFTC-history') ? 'selected' : '' }}>DFTC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">
                    <span class="hidden sm:inline">DUMLAO FARMER'S TRAINING CENTER</span>
                    <span class="sm:hidden">DFTC</span>
                </p>

                <div class="d-flex mt-2 justify-content-center align-items-center">
                    <div class="card w-100 xl:w-full bg-light-white mt-2 px-2">
                        <div class="row">
                            <div class="col-md-12 mt-2 mb-2">
                                <table class="table table-responsive table-striped table-hover w-auto" id="dftcHistoryTable">
                                        <thead>
                                            <th width="25%">Full Name</th>
                                            <th width="20%">Room Name</th>
                                            <th width="15%">Check In</th>
                                            <th width="15%">Check Out</th>
                                            <th width="5%">Amount</th>
                                            <th width="20%" class="text-center">Action Taken</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->fullname }}</td>
                                                    <td>{{ $booking->room_number}}</td>
                                                    <td>{{ $booking->check_in_date }}</td>
                                                    <td>{{ $booking->check_out_date }}</td>
                                                    @if ($booking->total_amount == "0.00" && $booking->position == "Student")
                                                        <td>FREE</td>
                                                    @else
                                                        <td>{{ $booking->total_amount }}</td>
                                                    @endif

                                                    <td class="text-center">
                                                        <button type="button" onclick="viewDftcHallBooking('{{ addslashes(json_encode($booking)) }}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;" title="View Button for hall"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="{{ url('generateDftcHistoryPdfReport') }}" target="_blank" class="btn btn-lg btn-info ml-4"><i class="fa-solid fa-file-pdf" style="color: #000000;"></i></a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="view-DftcRoom-modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Pre-Reservation Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12  border-4 rounded-md border-green-600">
                            <div class="row">
                                <div class="col-md-12 mb-2 bg-gray-100">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Account Information
                                    </div>
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
                            <div class="row mb-2 bg-gray-100">
                                <div class="col-md-12">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Booking Information
                                    </div>
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
                                    <p id="activityDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p id="roomNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1 bg-gray-100">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-1"></div>
                                    <p id="checkInDateDftcRoom-modal"></p>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkOutDateDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
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
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Optional Preferences
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p id="specialRequestDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Rates and Computation
                                    </div>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
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
                        <div class="col-md-12 border-4 rounded-md border-green-600">
                            <div class="row">
                                <div class="col-md-12 mb-2 bg-gray-100">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Account Information
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="fullNameDftcHall-modal"></p>                                  
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="emailDftcHall-modal"></p>                                      
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="contactDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="homeAddressDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-1">                                    
                                    <p id="positionDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="agencyDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-12 mb-2">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Booking Information
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="datetimeFilledUpDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="bookingNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p id="activityDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="roomNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkInDateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkOutDateDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfDaysDftcHall-modal"></p>    
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfNightsDftcHall-modal"></p>
                                </div>
                            </div>                            
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="arrivalDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="departureDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfMalesDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfFemalesDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-12 mb-2">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Optional Preferences
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p id="specialRequestDftcHall-modal"></p>       
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                        Rates and Computation
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Janitor Services</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="janitorServices-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">AV Services</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="avServices-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="rateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-1">
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
@endsection
