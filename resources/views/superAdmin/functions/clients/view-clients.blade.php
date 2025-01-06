@extends('superAdmin.layout')
@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countClients <= 2) style="height: 100vh;" @else style="height: auto;" @endif>
    <div class="row">
        <!-- Sidebar -->
        <div class="col-auto px-sm-2 px-0 min-h-min"  @if($countClients <= 2) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
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
                        <a href="{{ url('/superAdmin/view-guesthouse-canceled-preservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-guesthouse-canceled-preservations') || Request::is('superAdmin/view-staffhouse-canceled-preservations') || Request::is('superAdmin/view-DFTC-canceled-preservations') || Request::is('superAdmin/view-guesthouse-rejected-preservations') || Request::is('superAdmin/view-staffhouse-rejected-preservations') || Request::is('superAdmin/view-DFTC-rejected-preservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-ban"></i>
                            <span class="ms-1 d-none d-sm-inline">VOIDS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/superAdmin/view-clients') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('superAdmin/view-clients') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-users"></i>
                            <span class="ms-1 d-none d-sm-inline">CLIENTS</span>
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
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 3rem">CLIENTS</p>
            <p class="Montserrat text-3xl lg:text-5xl font-extrabold textGradient text-center mt-3">
                RECORDS
            </p>
            <div class="d-flex mt-3 md:mt-4 justify-content-center align-items-center">
                <div class="card w-100 xl:w-full bg-light-white mt-2 px-1">
                    <div class="row">
                        <div class="col-md-12 mt-2 mb-2">
                            <table class="table table-responsive table-striped table-hover w-auto" id="clientsTable">
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
                                            <button onclick="viewClient('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-info" title="View Button"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                            <button onclick="setPermissionClient('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-warning" title="Permission Button"><i class="fa-solid fa-id-card" style="color: #000000;"></i></button>
                                            @if ($client->status == "Active")
                                                <button onclick="deactivateClient('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-danger" title="Deactivate Button"><i class="fa-solid fa-user" style="color: #000000;"></i></button>
                                            @else
                                                <button onclick="activateClient('{{ addslashes(json_encode($client)) }}')" type="button" class="btn btn-danger" title="Activate Button"><i class="fa-solid fa-user" style="color: #000000;"></i></button>
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

<div class="modal fade" id="set-permission-client-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Set Permission Client Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="set-permission-client-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" id="client_ID" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Set Role</label>
                                                    <select name="set_role" id="rolePermission" class="form-control">
                                                        <option value="">Select Role</option>
                                                        <option value="Customer">Customer</option>
                                                        @foreach ($roleOptions as $role => $label)
                                                            @if ($rolesCount[$role] == 0)
                                                                <option value="{{ $role }}">{{ $label }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Warning! Are you sure you want to Change role of this account?
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-light-green Montserrat text-white hover:bg-dark-green">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="view-client-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Account Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 border-4 rounded-md border-green-600">
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="fullNameClient-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="emailClient-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="contactClient-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="homeAddressClient-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="positionClient-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Institution</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="institutionClient-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Status</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="statusClient-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Role</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="roleClient-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="activate-client-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Activate Client Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="activate-client-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" id="client_id" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Warning! Are you sure you want to activate this account?
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Activate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deactivate-client-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Deactivate Client Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="deactivate-client-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" id="clientId" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Warning! Are you sure you want to deactivate this account?
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Deactivate</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
