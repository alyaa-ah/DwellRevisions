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
                            <a href="{{ url('/adminDFTC/view-DFTC-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminDFTC/view-guesthouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">MY ACTIVITIES</p>
                <div class="row justify-content-center">
                    <div class="col-md-12 d-flex justify-content-center mt-2">
                            <!-- Buttons for medium and larger screens -->
                        <div class="button-group d-none d-md-flex">
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-my-guesthouse-canceled-pre-reservations') }}">Guest House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-my-staffhouse-canceled-pre-reservations') }}">Staff House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-my-DFTC-canceled-pre-reservations') }}">DFTC</a>
                        </div>
                    </div>  
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-2">
                        <!-- Buttons for small screens -->
                        <div class="select-group d-md-none">
                            <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:my-2 sm:w-full md:w-auto" onchange="location = this.value;">
                                <option class="{{ (Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations')) ? 'bg-light-green text-dark-white' : 'inactive' }}" value="{{ url('/adminDFTC/view-my-guesthouse-canceled-pre-reservations') }}" {{ (Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations*') || Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations')) ? 'selected' : '' }}>Guest House</option>
                                <option class="{{ (Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations')) ? 'bg-light-green text-dark-white' : 'inactive' }}" value="{{ url('/adminDFTC/view-my-staffhouse-canceled-pre-reservations') }}" {{ (Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations*') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations')) ? 'selected' : '' }}>Staff House</option>
                                <option class="{{ (Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-rejected-pre-reservations')) ? 'bg-light-green text-dark-white' : 'inactive' }}" value="{{ url('/adminDFTC/view-my-DFTC-canceled-pre-reservations') }}" {{ (Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations*') || Request::is('adminDFTC/view-my-DFTC-rejected-pre-reservations')) ? 'selected' : '' }}>DFTC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-canceled-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-my-DFTC-canceled-pre-reservations') }}">Canceled</a>
                        <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-my-guesthouse-rejected-pre-reservations') || Request::is('adminDFTC/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminDFTC/view-my-DFTC-rejected-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-my-DFTC-rejected-pre-reservations') }}">Rejected</a>
                    </div>
                </div>

            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">REJECTED</p>
            <div class="container card w-100 bg-light-white mt-2">  
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="myDftcRejectedTableAdminDftc">
                            <thead>
                                <th width="20%">Room Name</th>
                                <th width="15%">Check In Date</th>
                                <th width="15%">Check Out Date</th>
                                <th width="15%">Status</th>
                                <th width="5%">Amount</th>
                                <th width="30%" style="text-align: left;">Reason</th>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
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
</div>
@endsection
