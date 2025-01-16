@extends('client/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min"  @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-4">
                        <a href="{{ url('/client/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-ratings') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-ratings') || Request::is('client/view-staffhouse-ratings') || Request::is('client/view-DFTC-ratings') ? 'bg-dark-green text-dark-white' : '' }}"> <i class="fas fa-star"></i>
                            <span class="ms-1 d-none d-sm-inline">RATINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-preservations') || Request::is('client/view-staffhouse-preservations') || Request::is('client/view-DFTC-preservations') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-history') || Request::is('client/view-staffhouse-history') || Request::is('client/view-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/client/view-guesthouse-canceled-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-guesthouse-canceled-preservations') || Request::is('client/view-staffhouse-canceled-preservations') || Request::is('client/view-DFTC-canceled-preservations') || Request::is('client/view-guesthouse-rejected-preservations') || Request::is('client/view-staffhouse-rejected-preservations') || Request::is('client/view-DFTC-rejected-preservations') ? 'bg-dark-green text-dark-white' : '' }}">                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS </span>
                        </a>
                    </li>
                    <li class="border-b border-gray-300 w-full">
                        <a href="{{ url('/client/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('client/view-account')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-guesthouse-canceled-preservations') || Request::is('client/view-guesthouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-guesthouse-canceled-preservations') }}">Guest House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-staffhouse-canceled-preservations') || Request::is('client/view-staffhouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-staffhouse-canceled-preservations') }}">Staff House</a>
                            <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-DFTC-canceled-preservations') || Request::is('client/view-DFTC-rejected-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-DFTC-canceled-preservations') }}">DFTC</a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-2">
                        <!-- Buttons for small screens -->
                        <div class="select-group d-md-none">
                            <select class="form-select h-9 Montserrat bg-light-green text-dark-white sm:-2 sm:w-full md:w-auto" onchange="location = this.value;">
                                <option class="{{ Request::is('client/view-guesthouse-canceled-preservations*') || Request::is('client/view-guesthouse-rejected-preservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-guesthouse-canceled-preservations') }}" {{ Request::is('client/view-guesthouse-canceled-preservations*') || Request::is('client/view-guesthouse-canceled-preservations*') ? 'selected' : '' }}>Guest House</option>
                                <option class="{{ Request::is('client/view-staffhouse-canceled-preservations*') || Request::is('client/view-staffhouse-rejected-preservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-staffhouse-canceled-preservations') }}" {{ Request::is('client/view-staffhouse-canceled-preservations*') || Request::is('client/view-staffhouse-rejected-preservations*') ? 'selected' : '' }}>Staff House</option>
                                <option class="{{ Request::is('client/view-DFTC-canceled-preservations*') || Request::is('client/view-DFTC-rejected-preservations*') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-DFTC-canceled-preservations') }}" {{ Request::is('client/view-DFTC-canceled-preservations*') || Request::is('client/view-DFTC-rejected-preservations*') ? 'selected' : '' }}>DFTC</option>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="row justify-content-center">
                <div class="col-md-12 d-flex justify-content-center mt-1">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-staffhouse-canceled-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-staffhouse-canceled-preservations') }}">Canceled</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('client/view-staffhouse-rejected-preservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-staffhouse-rejected-preservations') }}">Rejected</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">REJECTED</p>
            <div class="container card w-100 bg-light-white mt-2">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="rejectedStaffHouseClient">
                            <thead>
                                <tr>
                                    <th width="20%">Room Name</th>
                                    <th width="15%">Check In Date</th>
                                    <th width="15%">Check Out Date</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="5%">Amount</th>
                                    <th width="30%" style="text-align: left;">Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
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
