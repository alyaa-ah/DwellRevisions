@extends('adminDftc/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" style="height: auto;">
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" style="background-color: #1ABC02;">
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

        <!-- Main Content -->
        <div class="col-9 col-md-10 content m-3 mx-auto items-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">ACCOUNT</p>
            <p class="Montserrat text-3xl lg:text-5xl font-extrabold textGradient text-center mt-3">
                PROFILE
            </p>
            <div class="d-flex justify-content-center align-items-center">
                <div class="card w-100 xl:w-full bg-light-white mt-2 px-2">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-striped table-hover w-auto" id="accountTableAdminDftc">
                                <thead>
                                    <tr>
                                        <th width="20%">Full Name</th>
                                        <th width="10%">Position</th>
                                        <th width="20%">Institution</th>
                                        <th style="text-align: left" width="10%">Contact</th>
                                        <th width="5%">Status</th>
                                        <th width="5%">Role</th>
                                        <th width="15%" class="text-center">Action Taken</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->fullname }}</td>
                                            <td>{{ $client->position }}</td>
                                            <td>{{ $client->agency }}</td>
                                            <td style="text-align: left">{{ $client->contact }}</td>
                                            <td>{{ $client->status }}</td>
                                            <td>{{ $client->role }}</td>
                                            <td class="text-center">
                                                <button onclick="viewAccountAdminDftc('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-info" title="View Button"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                                <button onclick="editAccountAdminDftc('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-warning" title="Edit Button"><i class="fa-solid fa-edit" style="color: #000000;"></i></button>
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
                <div class="container  border-4 rounded-md border-green-600">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="fullNameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="emailAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Username</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="usernameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="contactAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p id="homeAddressAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="positionAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Institution</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="institutionAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Status</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="statusAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Role</p>
                                </div>
                                <div class="col-md-4 my-2">
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
                            <h3 class="text-danger h6">Update necessary changes.</h3>
                            <h3 class="text-danger h6">Old password is required when modifying your account.</h3>
                            <form method="POST" id="edit-account-form">
                                <div class="row"  hidden>
                                    <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                        <label for="clientID">Client ID</label>
                                        <input type="text" class="form-control" name="client_id" id="clientID" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" class="form-control" name="fullname" id="edit-fullname-account" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="edit-email-account" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="position">Position</label>
                                            <select name="position" id="edit-position-account" class="form-control readonly-select" style="background-color:#d3d3d3;">
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
                                            <input type="text" class="form-control" name="agency" id="edit-agency-account" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" name="contact" id="edit-contact-account" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" id="edit-address-account" style="background-color:#d3d3d3;" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group Montserrat text-sm font-semibold text-light-green">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="edit-username-account" style="background-color:#d3d3d3;" readonly>
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
@endsection
