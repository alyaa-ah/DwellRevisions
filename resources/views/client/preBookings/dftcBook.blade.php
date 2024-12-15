@extends('client/layout')

@section('content')
<div class="outer-container">
    <div class="container flex-column d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-duration="800">
        <div class="row align-items-center m-1">
            <div class="col-md-12 text-center">
                <br><br><br>
                <div class="button-group d-none d-md-flex">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-guesthouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right:5px;"  href="{{ url('/client/view-guesthouse-pre-reservation-form') }}">Guest House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-staffhouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right:5px;"  href="{{ url('/client/view-staffhouse-pre-reservation-form') }}">Staff House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-DFTC-room-pre-reservation-form') || Request::is('client/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('client/view-DFTC-room-pre-reservation-form') }}">DFTC</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="width:80%;" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 mt-2">
                <!-- Buttons for small screens -->
                <div class="select-group d-md-none">
                    <select class="form-select h-9 Montserrat bg-light-green text-dark-white w-100" style="width:100%;" onchange="location = this.value;">
                        <option class="{{ Request::is('client/view-guesthouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-guesthouse-pre-reservation-form') }}" {{ Request::is('client/view-guesthouse-pre-reservation-form') ? 'selected' : '' }}>Guest House</option>
                        <option class="{{ Request::is('client/view-staffhouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-staffhouse-pre-reservation-form') }}" {{ Request::is('client/view-staffhouse-pre-reservation-form') ? 'selected' : '' }}>Staff House</option>
                        <option class="{{ Request::is('client/view-DFTC-room-pre-reservation-form') || Request::is('client/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'bg-gray-300 text-gray-600' }}" value="{{ url('/client/view-DFTC-room-pre-reservation-form') }}" {{ Request::is('client/view-DFTC-room-pre-reservation-form') || Request::is('client/view-DFTC-hall-pre-reservation-form') ? 'selected' : '' }}>DFTC</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <div class="col-md-12">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-DFTC-room-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-DFTC-room-pre-reservation-form') }}">Room</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('/client/view-DFTC-hall-pre-reservation-form') }}">Hall</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2">
                <p class="Montserrat h-12 mt-2 sm:h-14 md:h-16 lg:h-20 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold textGradient">
                    <span class="hidden sm:inline">DUMLAO FARMER'S TRAINING CENTER</span>
                    <span class="sm:hidden">DFTC ROOMS</span>
                </p>
                <p class="Montserrat text-md font-bold textGradient text-center">FACILITY</p>
            </div>
        </div>
    </div>
</div>
<div class="container z-1 mt-3 mb-4  d-flex flex-column justify-content-center align-items-center">
    <div class="card bg-light-white lg:w-9/12 sm:width:100%" data-aos="fade-up" data-aos-duration="800">
        <div class="card-body mx-2">
            <form id="dftc-booking-form">
                @csrf
                <div class="container mx-auto mt-2">
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row">
                            <div class="col-md-12 text-center mb-2">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Personal Information</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="fullName" class="Montserrat text-sm font-semibold">Full Name<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="fullname" id="fullName"  style="background-color:#d3d3d3;"  style="background-color:#d3d3d3;" placeholder="Please insert your full name here." value="{{ isset($user['fullname']) ? $user['fullname'] : session('loggedInCustomer')['fullname'] }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="positionDftc" class="Montserrat text-sm font-semibold">Position/Designation<span class="text-red-600">*</span></label>
                                    @php
                                        $position = isset($user['position']) ? $user['position'] : session('loggedInCustomer')['position'] ?? '';
                                        $isReadonly = isset($user['position']) || session('loggedInCustomer')['position'] ? true : false;
                                    @endphp
                                    <select name="position" id="positionDftc" class="form-control @if($isReadonly) readonly-select @endif" style="background-color:#d3d3d3;"  style="background-color:#d3d3d3;"  @if($isReadonly) readonly @endif>
                                        <option value="">Select Position/Designation</option>
                                        <option value="Guest" {{ $position == 'Guest' ? 'selected' : '' }}>Guest</option>
                                        <option value="Student" {{ $position == 'Student' ? 'selected' : '' }}>Student</option>
                                        <option value="Employee" {{ $position == 'Employee' ? 'selected' : '' }}>Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="email" class="Montserrat text-sm font-semibold">Email Address<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email"  style="background-color:#d3d3d3;" placeholder="Please insert your gmail address here." value="{{ isset($user['email']) ? $user['email'] : session('loggedInCustomer')['email'] }}" readonly required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="address" class="Montserrat text-sm font-semibold">Home Address<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address"  style="background-color:#d3d3d3;" placeholder="Please insert your home address here." value="{{ isset($user['address']) ? $user['address'] : session('loggedInCustomer')['address'] }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="agency" class="Montserrat text-sm font-semibold">Department/Agency/College<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="agency" id="agency"  style="background-color:#d3d3d3;" placeholder="Please insert your institution here." value="{{ isset($user['agency']) ? $user['agency'] : session('loggedInCustomer')['agency'] }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="contactNumber" class="Montserrat text-sm font-semibold">Contact Number<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="contactnumber" id="contactNumber"  style="background-color:#d3d3d3;"placeholder="Please insert your contact number here." value="{{ isset($user['contact']) ? $user['contact'] : session('loggedInCustomer')['contact'] }}" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row mb-2" id="letterInputCellDftc" style="display: none;">
                                <div class="col-12">
                                    <div class="form-group text-light-green">
                                        <label for="hasLetter" class="Montserrat text-sm font-semibold">
                                            Do you have the letter approved by the President or Campus Administrator to access services? (Exclusive to students)
                                        </label>
                                        <div class="mt-2">
                                            <!-- Radio button for "No" option -->
                                            <label class="Montserrat text-sm font-semibold">
                                                <input type="radio" name="hasLetterDftc" value="Yes"> Yes
                                            </label>

                                            <!-- Radio button for "Yes" option -->
                                            <label class="Montserrat text-sm font-semibold ml-3">
                                                <input type="radio" name="hasLetterDftc" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Duration of Stay</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="row mb-1">
                                    <div class="form-group text-light-green">
                                        <label for="room_numberDftc" class="Montserrat text-sm font-semibold">Room Number<span class="text-red-600">*</span></label>
                                        <select name="room_number" id="room_numberDftc" class="form-control" @if(isset($data['id'])) readonly required @endif>
                                            @if (isset($data['id']))
                                                <option value="{{ $data['id'] }}">{{ $data['room_number'] }}</option>
                                            @else
                                                <option value="">Select Room</option>
                                                @foreach($roomnumbers as $room)
                                                    @if($room->room_type != "Hall")
                                                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group text-light-green">
                                        <label for="numberOfDaysDftc" class="Montserrat text-sm font-semibold">Number Of Days</label>
                                        <input type="text" class="form-control" style="background-color:#d3d3d3;" placeholder="0" name="numberOfDays" id="numberOfDaysDftc" readonly>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group text-light-green">
                                        <label for="numberOfNightsDftc" class="Montserrat text-sm font-semibold">Number Of Nights</label>
                                        <input type="text" class="form-control" style="background-color:#d3d3d3;" placeholder="0" name="numberOfNights" id="numberOfNightsDftc" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkInDateDftc" class="Montserrat text-sm font-semibold">Check-In Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkInDate" id="checkInDateDftc" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="arrivalDftc" class="Montserrat text-sm font-semibold">Time Arrival <span class="text-red-600">(Fixed based on regulations)</span></label>
                                            <input type="time" class="form-control" name="arrival" id="arrivalDftc" style="background-color:#d3d3d3;" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkOutDateDftc" class="Montserrat text-sm font-semibold">Check-Out Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkOutDate" id="checkOutDateDftc" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="departureDftc" class="Montserrat text-sm font-semibold">Time Departure <span class="text-red-600">(Fixed based on regulations)</span></label>
                                            <input type="time" class="form-control" name="departure" id="departureDftc" style="background-color:#d3d3d3;" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfMaleDftc" class="Montserrat text-sm font-semibold">Number of Male<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfMale" id="numOfMaleDftc" placeholder="Type 0 if none" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfFemaleDftc" class="Montserrat text-sm font-semibold">Number of Female<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfFemale" id="numOfFemaleDftc" placeholder="Type 0 if none" value="0"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row mb-2">
                            <div class="col-md-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Rates and Computation</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="rate" class="Montserrat text-sm font-semibold">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rateDftc" style="background-color:#d3d3d3;" placeholder="0.00" value="{{ isset($data['room_rate']) ? $data['room_rate'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="capacity" class="Montserrat text-sm font-semibold">Room Bed Capacity</label>
                                    <input type="text" class="form-control" name="capacity" id="capacityDftc" style="background-color:#d3d3d3;" placeholder="0" value="{{ isset($data['room_capacity']) ? $data['room_capacity'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="totalAmount"  class="Montserrat text-sm font-semibold">Total Amount</label><br>
                                    <input type="text" class="form-control" name="totalAmount" id="totalAmountDftc" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row mb-2">
                            <div class="col-md-12 text-center">
                                <h4 class="Montserrat text-xl font-semibold text-light-green">Optional Preference</h4>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="specialRequests" class="Montserrat text-sm font-semibold"s>Special Requests</label>
                                    <textarea class="form-control" name="specialRequests" id="specialRequestsDftc" cols="5" rows="5" placeholder="Please enter your special request here(Optional)""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="error-message" class="alert alert-danger mt-2" style="display: none;">

                    </div>
                    <div class="row mb-2">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-toggle="modal" data-bs-target="#dftcTerms">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Terms and Conditions for DFTC Modal -->
<div class="modal modal-lg fade" id="dftcTerms" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">
                    <span class="hidden md:inline"> DUMLAO FARMERS' TRAINING CENTER</span>
                    <span class="inline md:hidden">DFTC</span> USE REQUEST
                </h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyPreBookDftcRoom" style="max-height: 400px; overflow-y: auto;">
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
                    <div id="error-message-modal" class="alert alert-danger mt-2" style="display: none;">

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mr-1" id="checkboxContainerPreBookDftcRoom" style="display: none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultDFTC">
                                    <label class="form-check-label text-white Montserrat text-sm font-semibold" for="flexCheckDefaultDFTC" style="margin-left: 0;">
                                        I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="submitButtonDFTC" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('modalBodyPreBookDftcRoom').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

        if (Math.ceil(this.scrollTop) >= scrollable - 10) {
            document.getElementById('checkboxContainerPreBookDftcRoom').style.display = 'block';
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

    document.addEventListener("DOMContentLoaded", function () {
       const arrivalInput = document.getElementById("arrivalDftc");
       const departureInput = document.getElementById("departureDftc");

       arrivalInput.value = "14:00";
       departureInput.value = "12:00";
   });
</script>

@endsection
