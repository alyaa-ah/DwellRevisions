@extends('adminSH/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center"  @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >
    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" @if($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;" @endif>
            <div class="d-flex flex-column align-items-center text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start flex-column mt-5 mb-auto Montserrat font-semibold">
                    <li class="border-top border-bottom w-full mt-5">
                        <a href="{{ url('/adminSH/view-dashboard') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-dashboard') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-house"></i>
                            <span class="ms-1 d-none d-sm-inline">DASHBOARD</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-rooms') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rooms') || Request::is('adminSH/create-room') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-door-open"></i>
                            <span class="ms-1 d-none d-sm-inline">ROOMS</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-ongoing-staffhouse-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-ongoing-staffhouse-pre-reservations') || Request::is('adminSH/view-pending-staffhouse-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="ms-1 d-none d-sm-inline">PRE-BOOKINGS</span></a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-staffhouse-history') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-staffhouse-history')  ? 'bg-dark-green text-dark-white' : '' }}">
                            <i class="fas fa-history"></i>
                            <span class="ms-1 d-none d-sm-inline">HISTORY</span>
                        </a>
                    </li>
                    <li class="border-bottom w-full">
                        <a href="{{ url('/adminSH/view-canceled-pre-reservations') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-rejected-pre-reservations') || Request::is('adminSH/view-canceled-pre-reservations')  ? 'bg-dark-green text-dark-white' : '' }}">
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
                                <a href="{{ url('/adminSH/view-my-ongoing-staffhouse-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-ongoing-guesthouse-pre-reservations') || Request::is('adminSH/view-my-ongoing-staffhouse-pre-reservations') || Request::is('/adminSH/view-my-ongoing-DFTC-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span class="ms-1">PRE-BOOKINGS</span>
                                </a>
                            </li>
                            <li class="border-bottom w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-history') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('adminSH/view-my-guesthouse-history') || Request::is('adminSH/view-my-staffhouse-history') || Request::is('adminSH/view-my-DFTC-history') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-history"></i>
                                    <span class="ms-1">HISTORY</span>
                                </a>
                            </li>
                            <li class="border-gray-300 w-full">
                                <a href="{{ url('/adminSH/view-my-staffhouse-canceled-pre-reservations') }}" class="dropdown-item text-white hover:bg-medium-green {{ Request::is('/adminSH/view-my-guesthouse-canceled-pre-reservations') || Request::is('adminSH/view-my-staffhouse-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-canceled-pre-reservations') || Request::is('adminSH/view-my-DFTC-rejected-pre-reservations') || Request::is('adminSH/view-my-staffhouse-rejected-pre-reservations') || Request::is('adminSH/view-my-guesthouse-rejected-pre-reservations') ? 'bg-dark-green text-dark-white' : '' }}">
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">VOIDS</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="border-b border-ray-300 w-full">
                        <a href="{{ url('/adminSH/view-account') }}" class="nav-link text-white hover:bg-medium-green {{ Request::is('adminSH/view-account') ? 'bg-dark-green text-dark-white' : '' }}">
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
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-ongoing-staffhouse-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-ongoing-staffhouse-pre-reservations') }}">Current</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminSH/view-pending-staffhouse-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminSH/view-pending-staffhouse-pre-reservations') }}">Pending</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl  font-extrabold textGradient text-center" style="margin-top: 1rem">PENDINGS</p>
            <div class="container card w-full bg-light-white mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="staffHousePendingBookingTableAdminSH">
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
                                            <button type="button" onclick="viewPendingStaffHouseBookingAdminSH('{{ addslashes(json_encode($booking) )}}')" class="btn btn-info"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button>
                                            <button type="button" onclick="reviewStaffHouseBookingAdminSH('{{ addslashes(json_encode($booking)) }}')" class="btn btn-warning"><i class="fa-solid fa-book" style="color: #000000;"></i></button>
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
<div class="modal fade" id="reviewModal">
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
                            <form id="status-clientbooking-form">
                                <div class="form-group Montserrat text-sm font-semibold" hidden>
                                    <label for="reviewStatus" class="form-group text-light-green">Booking ID</label>
                                    <input type="text" class="form-control" name="booking_id" id="booking_status_id">
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold">
                                    <label for="reviewStatus" class="form-group text-light-green">Review Status</label>
                                    <select id="reviewStatus" name="status" class="form-control" onchange="toggleReasonSelect()">
                                        <option value="">Select status</option>
                                        <option value="Reviewed">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold" id="reasonGroup" style="display:none;">
                                    <label for="reason" class="form-group text-light-green">Reason</label>
                                    <select name="reason" id="reason" class="form-control" onchange="toggleOtherReason()">
                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                        <option value="Unclear pre-booking information.">Unclear pre-booking information</option>
                                        <option value="Room is not available at the moment.">Room is not available at the moment</option>
                                        <option value="No available attendants.">No available attendants</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold" id="otherReasonGroup" style="display:none;">
                                    <label for="other_reason" class="form-group text-light-green">Specify Reason</label>
                                    <input type="text" name="other_reason" id="other_reason" class="form-control" />
                                </div>

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

<div class="modal fade" id="view-staffhousebooking-modal" >
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
                                <div class="bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Account Information
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="fullNameStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="emailStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="contactStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="homeAddressStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="positionStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="agencyStaffHouse-modal"></p>
                                </div>
                            </div>

                            <!-- Booking Information -->
                            <div class="row">
                                <div class="bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="datetimeFilledUpStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="bookingNumberStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="activityStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="roomNumberStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkInDateStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkOutDateStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfDaysStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfNightsStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="arrivalStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="departureStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfMalesStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfFemalesStaffHouse-modal"></p>
                                </div>
                            </div>

                            <!-- Optional Preferences -->
                            <div class="row">
                                <div class="bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Additional Bedding</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="beddingStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Mode of Payment</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="paymentStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="specialRequestStaffHouse-modal"></p>
                                </div>
                            </div>

                            <!-- Additional Information -->
                            <div class="row">
                                <div class="bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Additional Information
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Name of Male Guest(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <textarea class="form-control" id="maleStaffHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Name of Female Guest(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <textarea class="form-control" id="femaleStaffHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>

                            <!-- Rates and Computation -->
                            <div class="row">
                                <div class="bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row py-1 border-t border-b">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="rateStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="totalAmountStaffHouse-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleReasonSelect() {
    const reviewStatus = document.getElementById('reviewStatus').value;
    const reasonGroup = document.getElementById('reasonGroup');

    if (reviewStatus === 'Rejected') {
        reasonGroup.style.display = 'block'; // Show reason dropdown
    } else {
        reasonGroup.style.display = 'none'; // Hide reason dropdown
        document.getElementById('reason').value = ''; // Clear the reason dropdown
        toggleOtherReason(); // Ensure other input is cleared
    }
}

function toggleOtherReason() {
    const reasonSelect = document.getElementById('reason').value;
    const otherReasonGroup = document.getElementById('otherReasonGroup');

    if (reasonSelect === 'Others') {
        otherReasonGroup.style.display = 'block'; // Show the custom input field
    } else {
        otherReasonGroup.style.display = 'none'; // Hide the custom input field
        document.getElementById('other_reason').value = ''; // Clear custom input
    }
}
</script>
@endsection
