@extends('adminDftc/layout')

@section('content')
<div class="container-fluid m-0 w-full justify-content-center align-items-center" @if($countBookings <= 0) style="height: 100vh;" @else style="height: auto;" @endif >

    <div class="row">
        <!-- Sidebar -->
        <div  class="col-auto px-sm-2 px-0 min-h-min" @if ($countBookings <= 0) style="height: 100vh; background-color: #1ABC02;" @else style="height: auto; background-color: #1ABC02;"  @endif">
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
            <p class="Montserrat h-12 text-3xl font-extrabold textGradient" style="margin-top: 4rem">PRE-BOOKINGS</p>
            <div class="row justify-content-center">
            <div class="col-md-12 d-flex justify-content-center" style="margin-top: 1rem;">
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-ongoing-DFTC-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-ongoing-DFTC-pre-reservations') }}">Current</a>
                    <a class="btn btn-nav h-9 Montserrat mx-1 {{ Request::is('adminDFTC/view-pending-DFTC-pre-reservations') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-pending-DFTC-pre-reservations') }}">Pending</a>
                </div>
            </div>
            <p class="Montserrat h-12  lg:text-5xl text-3xl font-extrabold textGradient text-center" style="margin-top: 1rem">PENDINGS</p>
            <div class="container card w-12/12 bg-light-white mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive table-striped table-hover w-auto" id="dftcPendingBookingTableAdminDftc">
                            <thead>
                                <th width="25%">Full Name</th>
                                <th width="20%">Room Name</th>
                                <th width="15%">Check In</th>
                                <th width="15%">Check Out</th>
                                <th width="5%">Amount</th>
                                <th width="20%" class="text-center">Action Taken</th>
                            </thead>
                            <tbody>

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
                                <div class="form-group Montserrat text-sm font-semibold" hidden>
                                    <label for="reviewStatus" class="form-group text-light-green">Room ID</label>
                                    <input type="text" class="form-control" name="room_id" id="room_status_id">
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold">
                                    <label for="reviewStatus" class="form-group text-light-green">Review Status</label>
                                    <select id="reviewStatus" name="status" class="form-control" onchange="toggleReasonSelect()">
                                        <option value="">Select status</option>
                                        <option value="Reviewed">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold" id="receiptNumber" style="display:none;">
                                    <label for="or_number" class="form-group text-light-green">OR number</label>
                                    <input type="text" name="or_number" id="or_number" class="form-control" />
                                </div>
                                <div class="form-group Montserrat text-sm font-semibold" id="reasonGroup" style="display:none;">
                                    <label for="reason" class="form-group text-light-green">Reason</label>
                                    <select name="reason" id="reason" class="form-control" onchange="toggleOtherReason()">
                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                        <option value="Unclear pre-booking information.">Unclear pre-booking information</option>
                                        <option value="Room is not available at the moment.">Room is not available at the moment</option>
                                        <option value="This room is already reserved by someone else.">This room is already reserved by someone else</option>
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
</div>

<div class="modal fade" id="cancel-dftcbooking-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Cancellation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="cancel-dftc-form">
                                    @csrf
                                    <table class="table table-borderless mx-auto">
                                        <tbody>
                                            <tr hidden>
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group text-light-green">
                                                        <label for="room_id">Booking ID</label>
                                                        <input type="text" class="form-control" name="booking_id" id="DFTC_bookingID" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="Montserrat text-sm font-semibold">
                                                    <div class="form-group text-light-green">
                                                        <label for="reason">Reason</label>
                                                        <select name="reason" id="reasonDftc" class="form-control">
                                                            <option value="I've changed my mind.">I've changed my mind</option>
                                                            <option value="No longer needed.">No longer needed</option>
                                                            <option value="Conflict of schedule.">Conflict of schedule</option>
                                                            <option value="Conflict of schedule.">Conflict of schedule</option>
                                                            <option value="Unclear pre-booking information.">Unclear pre-booking information</option>
                                                            <option value="Room is not available at the moment.">Room is not available at the moment</option>
                                                            <option value="Room is already occupied.">Room is already occupied</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="Montserrat text-xl font-semibold">
                                                    <div class="text-light-green text-center">
                                                        Warning! Are you sure you want to cancel this pre-reservation?
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>

                                    </table>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
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
                        <div class="border-4 rounded-md border-green-600">
                            <!-- Account Information -->
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="fullNameDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="emailDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row  bg-gray-100 ">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="contactDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="homeAddressDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="positionDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="agencyDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="datetimeFilledUpDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="bookingNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="activityDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="roomNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkInDateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="checkOutDateDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfDaysDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfNightsDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="arrivalDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="departureDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfMalesDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="numOfFemalesDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row my-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center my-2">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 my-2">
                                    <p colspan="3" id="specialRequestDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row my-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Janitor Services</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="janitorServices-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">AV Services</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="avServices-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 my-2">
                                    <p id="rateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 my-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 my-2">
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
<script>
function toggleReasonSelect() {
    const reviewStatus = document.getElementById('reviewStatus').value;
    const reasonGroup = document.getElementById('reasonGroup');
    const receiptNumber = document.getElementById('receiptNumber');
    const otherReasonGroup = document.getElementById('otherReasonGroup');
    if (reviewStatus === 'Rejected') {
        reasonGroup.style.display = 'block';
        receiptNumber.style.display = 'none';
    } else if (reviewStatus === 'Reviewed') {
        reasonGroup.style.display = 'none';
        receiptNumber.style.display = 'block';
        otherReasonGroup.style.display = 'none';
    } else {
        reasonGroup.style.display = 'none';
        receiptNumber.style.display = 'none';
        document.getElementById('reason').value = '';
        toggleOtherReason();
    }
}

function toggleOtherReason() {
    const reasonSelect = document.getElementById('reason').value;
    const otherReasonGroup = document.getElementById('otherReasonGroup');
    const receiptNumber = document.getElementById('receiptNumber');
    if (reasonSelect === 'Others') {
        otherReasonGroup.style.display = 'block';
        receiptNumber.style.display = 'none';
    } else {
        otherReasonGroup.style.display = 'none';
        document.getElementById('other_reason').value = '';
    }
}
</script>
@endsection
