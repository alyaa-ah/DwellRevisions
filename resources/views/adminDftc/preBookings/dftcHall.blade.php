@extends('adminDftc/layout')

@section('content')
<div class="outer-container">
    <div class="container flex-column d-flex justify-content-center align-items-center">
        <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 text-center">
                <br><br><br>
                <div class="button-group d-none d-md-flex mt-3">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminDFTC/view-guesthouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminDFTC/view-guesthouse-pre-reservation-form') }}">Guest House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminDFTC/view-staffhouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminDFTC/view-staffhouse-pre-reservation-form') }}">Staff House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right: 5px;" href="{{ url('/adminDFTC/view-DFTC-room-pre-reservation-form') }}">DFTC</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="width:80%;" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 mt-4">
                <!-- Buttons for small screens -->
                <div class="select-group d-md-none">
                    <select class="form-select h-9 Montserrat bg-light-green text-dark-white w-100" style="width:100%;" onchange="location = this.value;">
                        <option class="{{ Request::is('adminDFTC/view-guesthouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminDFTC/view-guesthouse-pre-reservation-form') }}" {{ Request::is('adminDFTC/view-guesthouse-pre-reservation-form') ? 'selected' : '' }}>Guest House</option>
                        <option class="{{ Request::is('adminDFTC/view-staffhouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminDFTC/view-staffhouse-pre-reservation-form') }}" {{ Request::is('adminDFTC/view-staffhouse-pre-reservation-form') ? 'selected' : '' }}>Staff House</option>
                        <option class="{{ Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/adminDFTC/view-DFTC-room-pre-reservation-form') }}" {{ Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') || Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'selected' : '' }}>DFTC</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 mt-2">
                <div class="col-md-12">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminDFTC/view-DFTC-room-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-room-pre-reservation-form') }}">Room</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('adminDFTC/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/adminDFTC/view-DFTC-hall-pre-reservation-form') }}">Hall</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-duration="800">
            <p class="Montserrat h-12 mt-2 sm:h-14 md:h-16 lg:h-20 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold textGradient">
                <span class="hidden sm:inline">DUMLAO FARMER'S TRAINING CENTER</span>
                <span class="sm:hidden">DFTC HALL</span>
            </p>
            <p class="Montserrat text-md font-bold textGradient text-center">FACILITY</p>
        </div>
    </div>
</div>

<div class="container z-1 mt-3 mb-4 d-flex flex-column justify-content-center align-items-center">
    <div class="card bg-light-white lg:w-9/12 sm:width:100%" data-aos="fade-up" data-aos-duration="800">
        <div class="card-body mx-2">
            <form id="dftcHall-booking-form">
                @csrf
                <div class="container mx-auto mt-2">
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row mb-2">
                            <div class="col-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Personal Information</h4>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="fullName" class="Montserrat text-sm font-semibold">Full Name<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="fullname" id="fullName" placeholder="Please insert your full name here." value="{{ isset($user['fullname']) ? $user['fullname'] : '' }}" @if(isset($user['fullname'])) readonly required @endif>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="position" class="Montserrat text-sm font-semibold">Position/Designation<span class="text-red-600">*</span></label><br>
                                    <select name="position" id="positionHallDftc" class="form-control @if(isset($user['position'])) readonly-select @endif" @if(isset($user['position'])) readonly required @endif>
                                        <option value="">Select Position/Designation</option>
                                        <option value="Guest" {{ isset($user['position']) && $user['position'] == 'Guest' ? 'selected' : '' }}>Guest</option>
                                        <option value="Student" {{ isset($user['position']) && $user['position'] == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Employee" {{ isset($user['position']) && $user['position'] == 'Employee' ? 'selected' : '' }}>Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="Email" class="Montserrat text-sm font-semibold">Email Address<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Please insert your gmail address here." value="{{ isset($user['email']) ? $user['email'] : '' }}" @if(isset($user['email'])) readonly required @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="homeAddress" class="Montserrat text-sm font-semibold">Home Address<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Please insert your home address here." value="{{ isset($user['address']) ? $user['address'] : '' }}" @if(isset($user['address'])) readonly required @endif>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="agency" class="Montserrat text-sm font-semibold">Department/Agency/College<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="agency" id="agency" placeholder="Please insert your institution here." value="{{ isset($user['agency']) ? $user['agency'] : '' }}" @if(isset($user['agency'])) readonly required @endif>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group text-light-green">
                                    <label for="contactNumber" class="Montserrat text-sm font-semibold">Contact Number<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="contactnumber" id="contactNumber" placeholder="Please insert your contact number here." value="{{ isset($user['contact']) ? $user['contact'] : '' }}" @if(isset($user['contact'])) readonly required @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2" id="letterInputCellHallDftc" style="display: none;">
                            <div class="col-12">
                                <div class="form-group text-light-green">
                                    <label for="hasLetter" class="Montserrat text-sm font-semibold">
                                        Do you have the letter approved by the President or Campus Administrator to access services? (Exclusive to students)
                                    </label>
                                    <div class="mt-2">
                                        <!-- Radio button for "No" option -->
                                        <label class="Montserrat text-sm font-semibold">
                                            <input type="radio" name="hasLetterHallDftc" value="Yes"> Yes
                                        </label>

                                        <!-- Radio button for "Yes" option -->
                                        <label class="Montserrat text-sm font-semibold ml-3">
                                            <input type="radio" name="hasLetterHallDftc" value="No" checked> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group text-light-green">
                                    <label for="activity" class="Montserrat text-sm font-semibold">
                                        Activity <span class="text-red-600">*</span>
                                    </label>

                                    <!-- Dropdown with predefined options -->
                                    <select class="form-control" id="activitySelect" name="activitySelected" required>
                                        <option value="">Select an activity...</option>
                                        <option value="Meeting">Meeting</option>
                                        <option value="Workshop">Workshop</option>
                                        <option value="Seminar">Seminar</option>
                                        <option value="Others">Others</option>
                                    </select>

                                    <!-- Hidden textarea for custom activity -->
                                    <textarea
                                        class="form-control mt-2"
                                        id="activityTextArea"
                                        name="customActivity"
                                        placeholder="Please describe the custom activity here..."
                                        style="display: none;"
                                        rows="4"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row mb-2">
                            <div class="col-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Duration of Stay</h4>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <div class="form-group text-light-green mb-1">
                                    <label for="room_number" class="Montserrat text-sm font-semibold">Room Number<span class="text-red-600">*</span></label>
                                    <select name="room_number" id="room_numberHallDftc" class="form-control" @if(isset($data['id'])) readonly @endif required>
                                        @if (isset($data['id']))
                                            <option value="{{ $data['id'] }}">{{ $data['room_number'] }}</option>
                                        @else
                                        <option value="">Select Room</option>
                                            @foreach($roomnumbers as $room)
                                                @if($room->room_type == "Hall" && ($room->room_status != 'Occupied' && $room->room_status != 'Under-Renovation' && $room->room_status != 'Unavailable'))
                                                    <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="border-2 rounded-md border-gray-500 p-1" readonly>
                                    <div class="row mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numberofDays" class="Montserrat text-sm font-semibold">Number Of Days</label>
                                            <input type="text" class="form-control" name="numberOfDays" id="numberOfDaysHallDftc" style="background-color:#d3d3d3;" placeholder="This is read only" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numberofNights" class="Montserrat text-sm font-semibold">Number Of Nights</label>
                                            <input type="text" class="form-control" name="numberOfNights" id="numberOfNightsHallDftc" style="background-color:#d3d3d3;" placeholder="This is read only" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkInDate" class="Montserrat text-sm font-semibold">Check-In Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkInDate" id="checkInDateHallDftc" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="arrival" class="Montserrat text-sm font-semibold">Time Arrival<span class="text-red-600">*</span></label>
                                            <input type="time" class="form-control" name="arrival" id="arrivalHallDftc" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkOutDate" class="Montserrat text-sm font-semibold">Check-Out Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkOutDate" id="checkOutDateHallDftc" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="departure" class="Montserrat text-sm font-semibold">Time Departure<span class="text-red-600">*</span></label>
                                            <input type="time" class="form-control" name="departure" id="departureHallDftc" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfMale" class="Montserrat text-sm font-semibold">Number of Male<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfMale" id="numOfMaleHallDftc" placeholder="Type 0 if none" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfFemale" class="Montserrat text-sm font-semibold">Number of Female<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfFemale" id="numOfFemaleHallDftc" placeholder="Type 0 if none" value="0" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row mb-2">
                            <div class="col-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Rates and Computation</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="rate" class="Montserrat text-sm font-semibold">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rateHallDftc" style="background-color:#d3d3d3;" placeholder="This is read only" value="{{ isset($data['room_rate']) ? $data['room_rate'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="capacity" class="Montserrat text-sm font-semibold">Max Capacity</label>
                                    <input type="text" class="form-control" name="capacity" id="capacityHallDftc" style="background-color:#d3d3d3;" placeholder="This is read only" value="{{ isset($data['room_capacity']) ? $data['room_capacity'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="totalAmount" class="Montserrat text-sm font-semibold">Total Amount</label><br>
                                    <input type="text" class="form-control" name="totalAmount" id="totalAmountHallDftc" style="background-color:#d3d3d3;" placeholder="This is read only" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-sm text-light-green">
                                            <label for="janitorservices" class="Montserrat text-sm font-semibold">Janitorial Services</label>
                                            <input type="number" name="janitorservices" id="janitorservices" placeholder="This is read only" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="extracharge" class="Montserrat text-sm font-semibold">Exceed 8 hrs Extra Charge</label>
                                            <input type="number" name="extracharge" id="extracharge" class="form-control" placeholder="This is read only" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-sm text-light-green">
                                            <label for="avservices" class="Montserrat text-sm font-semibold">AV Services</label>
                                            <input type="number" name="avservices" id="avservices" class="form-control" placeholder="This is read only" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-sm text-light-green">
                                            <label for="timerate" class="Montserrat text-sm font-semibold">Night Time Rate</label>
                                            <input type="number" name="timerate" id="timerate" class="form-control" placeholder="This is read only" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                    <div class="form-group text-light-green">
                                        <label for="specialRequests" class="Montserrat text-sm font-semibold">Special Requests</label>
                                        <textarea class="form-control"  name="specialRequests" id="specialRequestsHallDftc" placeholder="Please enter your special request here(Optional)"" cols="5" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="error-messageDftcHall" class="alert alert-danger mt-2" style="display: none;">

                        </div>
                        <div class="row my-2">
                            <div class="col-12 text-right my-2">
                                <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-toggle="modal" data-bs-target="#dftcHallTerms">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<!-- Terms and Conditions for DFTC Modal -->
<div class="modal modal-lg fade" id="dftcHallTerms" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">
                    <span class="hidden md:inline"> DUMLAO FARMERS' TRAINING CENTER</span>
                    <span class="inline md:hidden">DFTC</span> USE REQUEST
                </h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyPreBookDftcHall" style="max-height: 400px; overflow-y: auto;">
                <p class="Montserrat text-md font-bold font">TERMS AND CONDITION OF PAYMENT</p>
                <p class="Montserrat text-sm font-semibold">Payables should be settled on or before departure date and directly yo the Cashier's Office. (With order of payment to be secured at the Auxiliary Services Office)</p><br>
                <p class="Montserrat text-md font-bold font">CONTRACT AND GUIDELINES FOR THE USAGE OF FACILITIES OF THE DUMLAO FARMERS' TRAINING CENTER</p>
                <p class="Montserrat text-sm font-semibold text-justify">1. Request for use of any of the facilities of the Training Center shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">2. For outside sponsored activity, the requesting party should pay at least 50% of the total amount of the requested hall as down payment and the remaining 50% shall be paid on or before the activity date at the Cashier's Office before the approval of the ASP Director. For lodging purposes, payment can be made before or after the accommodation. Payment shall be billed by the Project-in-Charge and paid at the Cashiers Office.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">3. For maximum use of the services, a request for the cancellation of postponement of any sponsored activity shall be allowed without fine; provided that such request for cancellation shall be filed 3 days before the said activity. Violation of this clause shall result to forfeiture.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">4. The cleanliness and orderliness of the facilities before and after use shall be observed by the contracting party/group concerned.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">5. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE CENTER. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">6. Any DFTC property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party. The University shall not be liable for loss of personal properties.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">7. The presence of the University Food Services is a pre-requisite in any instances to cater the food requirements of the contracting party. Outside caterers shall not be allowed to provide meals for any occasion participants unless prior arrangements were made with the Office of the Auxiliary Services Program and shall pay CORKAGE FEE of P500.00 for less than 50 participants, P750.00 for less than 100 participants, and P1,000.00 for more than 100 participants per day.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">8. This <b>CONTRACT APPLIES</b> for the use of the <b>DUMLAO FARMERS' TRAINING CENTER ONLY.</b></p>
            </div>
            <div class="modal-footer bg-light-green">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mr-1" id="checkboxContainerPreBookDftcHall" style="display:none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultDFTCHall">
                                    <label class="form-check-label text-white Montserrat text-sm font-semibold" for="flexCheckDefault" style="margin-left: 0;">
                                        I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitButtonDFTCHall" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('modalBodyPreBookDftcHall').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

        if (Math.ceil(this.scrollTop) >= scrollable - 10) {
            document.getElementById('checkboxContainerPreBookDftcHall').style.display = 'block';
        }
    });
document.addEventListener("DOMContentLoaded", function() {
    const activitySelect = document.getElementById("activitySelect");
    const activityTextArea = document.getElementById("activityTextArea");


activitySelect.addEventListener("change", function() {
        if (activitySelect.value === "Others") {

            activityTextArea.style.display = "block";
            activityTextArea.required = true;
            activityTextArea.focus();
        } else {

            activityTextArea.style.display = "none";
            activityTextArea.value = "";
            activityTextArea.required = false;
        }
    });
        activityTextArea.addEventListener("input", function() {
        activitySelect.value = "Others";
    });
});
</script>
@endsection
