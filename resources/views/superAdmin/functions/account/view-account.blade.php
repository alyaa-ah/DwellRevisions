@extends('superAdmin.layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
         <!-- Sidebar -->
         <div class="col-auto px-sm-2 px-0 min-h-min"  style="height: auto; background-color: #1ABC02;">
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
        <div class="col-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">ACCOUNT</p>
            <p class="Montserrat text-3xl lg:text-5xl font-extrabold textGradient text-center mt-3">
                PROFILE
            </p>
            <div class="d-flex mt-3 md:mt-4 justify-content-center align-items-center">
                <div class="card w-full bg-light-white mt-2 px-1">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <table class="table table-responsive w-auto" id="accountTable">
                                <thead>
                                    <th width="20%">Full Name</th>
                                    <th width="10%">Position</th>
                                    <th width="20%">Institution</th>
                                    <th style="text-align: left" width="10%">Contact</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="5%">Role</th>
                                    <th width="15%" class="text-center">Action Taken</th>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->fullname }}</td>
                                        <td>{{ $client->position }}</td>
                                        <td>{{ $client->agency }}</td>
                                        <td style="text-align: left">{{ $client->contact }}</td>
                                        <td class="status-cell">
                                            @if ($client->status == 'Active')
                                                <span class="status-badge approved">
                                                    <i class="fas fa-smile"></i> Active
                                                </span>
                                            @elseif ($client->status == 'Inactive')
                                                <span class="status-badge rejected">
                                                    <i class="fas fa-frown"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $client->role }}</td>
                                        <td class="text-center">
                                            <button onclick="viewAccount('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-info" title="View Button"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                            <button onclick="editAccount('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-warning" title="Edit Button"><i class="fa-solid fa-edit" style="color: #000000;"></i></button>
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

<div class="modal fade" id="view-account-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Account Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container border-4 rounded-md border-green-600">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="fullNameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <td class="h6">Email</td>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="emailAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Username</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="usernameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="contactAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="homeAddressAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="positionAccount-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Institution</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="institutionAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                <p class="h6">Status</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                <p id="statusAccount-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                <p class="h6">Role</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                <p id="roleAccount-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="edit-account-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" >
                <div class="modal-header bg-light-green">
                    <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Edit Account</h1>
                    <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="col-md-12">
                                <form method="POST" id="edit-account-form">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="fullname">Full Name</label>
                                                <input type="text" class="form-control" name="fullname" id="edit-fullname-account">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="edit-email-account" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="position">Position</label>
                                                <select name="position" id="edit-position-account" class="form-control">
                                                    <option value="">Select Position</option>
                                                    <option value="Guest">Guest</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Employee">Employee</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="agency">Department/Agency/College</label>
                                                <input type="text" class="form-control" name="agency" id="edit-agency-account">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="contact">Contact</label>
                                                <input type="text" class="form-control" name="contact" id="edit-contact-account">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="edit-address-account">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="edit-username-account">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="address">Old Password</label>
                                                <input type="password" class="form-control" name="old_password" id="edit-oldpassword-account">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="username">New Password</label>
                                                <input type="password" class="form-control" name="new_password" id="edit-newpassword-account">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                                <label for="address">Re-type Password</label>
                                                <input type="password" class="form-control" name="re_password" id="edit-repassword-account">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-end">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green" style="text-align: right">
                                            <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Submit</button>
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
</div>
@endsection
