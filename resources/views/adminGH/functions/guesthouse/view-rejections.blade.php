@extends('adminGH/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center"  @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-16">
                        <a href="{{ url('/adminGH/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminGH/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-rooms')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminGH/view-ongoing-guesthouse-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-ongoing-guesthouse-pre-reservations') || Request::is('adminGH/view-pending-guesthouse-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminGH/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-guesthouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminGH/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-rejected-pre-reservations') || Request::is('adminGH/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                                <a href="{{ url('/adminGH/view-my-ongoing-guesthouse-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminGH/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminGH/view-my-ongoing-staffhouse-pre-reservations') || Request::is('/adminGH/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="ms-1">PRE-BOOKINGS</span>
                                </a>
                            </li>
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminGH/view-my-guesthouse-history') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminGH/view-my-guesthouse-history') || Request::is('adminGH/view-my-staffhouse-history') || Request::is('adminGH/view-my-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-history"></i>
                                    <span class="ms-1">HISTORY</span>
                                </a>
                            </li>
                            <li class="border-gray-300 w-full">
                                <a href="{{ url('/adminGH/view-my-guesthouse-canceled-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('/adminGH/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminGH/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminGH/view-my-DFTC-canceled-pre-reservations') || Request::is('adminGH/view-my-DFTC-rejected-pre-reservations') || Request::is('adminGH/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminGH/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">VOIDS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminGH/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminGH/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-user"></i>
                            <span class="ms-1 d-none d-sm-inline">ACCOUNT</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-9 col-md-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">VOIDS</p>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminGH/view-canceled-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminGH/view-canceled-pre-reservations') }}">Cancelled</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminGH/view-rejected-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminGH/view-rejected-pre-reservations') }}">Rejected</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">REJECTED</p>
            <div class="container card w-12/12 bg-light-white mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover" id="canceledGuestHouseAdminGH">
                            <thead>
                                <tr>
                                    <th width="20%">Full Name</th>
                                    <th width="12%">Room Name</th>
                                    <th width="15%">Check-in Date</th>
                                    <th width="15%">Check-out Date</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="30%" style="text-align: left;">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->fullname }}</td>
                                        <td>{{ $booking->room_number }}</td>
                                        <td>{{ $booking->check_in_date }}</td>
                                        <td>{{ $booking->check_out_date }}</td>
                                        <td class="status-cell">
                                            @if ($booking->status == 'Pending Review')
                                                <span class="status-badge pending">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @elseif ($booking->status == 'Canceled')
                                                <span class="status-badge canceled">
                                                    <i class="fas fa-times-circle"></i> Cancelled
                                                </span>
                                            @elseif ($booking->status == 'Rejected')
                                                <span class="status-badge rejected">
                                                    <i class="fas fa-ban"></i> Rejected
                                                </span>
                                            @else
                                                <span class="status-badge approved">
                                                    <i class="fas fa-check-circle"></i> Approved
                                                </span>
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
