@extends('superAdmin.layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-sm-2 px-0 min-h-min" @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
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
        <div class="col-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">VOIDS</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center mt-2">
                    <!-- Buttons for medium and larger screens -->
                    <div class="button-group d-none d-md-flex">
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}">Guest House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-staffhouse-canceled-preservations') }}">Staff House</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" href="{{ url('/superAdmin/view-DFTC-canceled-preservations') }}">DFTC</a>
                    </div>
                </div>  
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mt-2">
                <!-- Buttons for small screens -->
                    <div class="select-group d-md-none">
                        <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:my-2 sm:w-full md:w-auto" onchange="location = this.value;">
                            <option class="{{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}" {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') ? 'selected' : '' }}>Guest House</option>
                            <option class="{{ Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-staffhouse-canceled-preservations') }}" {{ Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') ? 'selected' : '' }}>Staff House</option>
                            <option class="{{ Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/superAdmin/view-DFTC-canceled-preservations') }}" {{ Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ? 'selected' : '' }}>DFTC</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}">Canceled</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('superAdmin/view-guesthouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/superAdmin/view-guesthouse-rejected-preservations') }}">Rejected</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">CANCELLED</p>
            <div class="d-flex mt-2 justify-content-center align-items-center">
                <div class="card w-100 xl:w-full bg-light-white mt-2 px-2">
                     <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <table class="table table-responsive table-hover table-striped w-auto" id="voidedGuestHouseTable">
                                <thead>
                                    <th width="20%">Full Name</th>
                                    <th width="12%">Room Name</th>
                                    <th width="15%">Check In Date</th>
                                    <th width="15%">Check Out Date</th>
                                    <th width="10%">Status</th>
                                    <th width="5%">Amount</th>
                                    <th width="30%" style="text-align: left;">Reason</th>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->fullname }}</td>
                                            <td>{{ $booking->room_number }}</td>
                                            <td>{{ $booking->check_in_date }}</td>
                                            <td>{{ $booking->check_out_date }}</td>
                                            <td>{{ $booking->status }}</td>
                                            <td>
                                                @if ($booking->total_amount == '0.00' && $booking->position == 'Student')
                                                    FREE
                                                @else
                                                    {{ $booking->total_amount }}
                                                @endif
                                            </td>
                                            <td>{{ $booking->reason }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
@endsection
