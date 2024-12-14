@extends('superAdmin.layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countAudits <= 2 ) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-sm-2 px-0 min-h-min" @if($countAudits <= 2 ) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
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
                            <span class="ms-1 d-none d-sm-inline">VOIDS</span>
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
        <div class="col-10 content mt-4 mb-1 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 2rem">ACTIVITY LOGS</p>
            <div class="d-flex mt-3 md:mt-4 justify-content-center align-items-center">
                <div class="card w-100 xl:w-full bg-light-white mt-2 px-1">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <table class="table table-responsive table-striped table-hover w-auto" id="auditTable">
                                <thead>
                                    <th width="25%">Full Name</th>
                                    <th width="35%">Activity</th>
                                    <th width="20%">Role</th>
                                    <th style="text-align: left" width="20%">Date and Time</th>
                                </thead>
                                <tbody>
                                    @foreach ($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->fullname }}</td>
                                        <td>{{ $audit->activity }}</td>
                                        <td>{{ $audit->role }}</td>
                                        <td style="text-align: left">
                                            {{ \Carbon\Carbon::parse($audit->created_at)->format('F j, Y g:i A') }}
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


@endsection
