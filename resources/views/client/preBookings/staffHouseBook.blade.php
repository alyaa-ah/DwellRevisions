@extends('client/layout')

@section('content')
<div class="outer-container">
    <div class="container flex-column d-flex justify-content-center align-items-center">
        <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12 text-center">
                <br><br><br>
                <div class="button-group d-none d-md-flex">
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-guesthouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right:5px;"  href="{{ url('/client/view-guesthouse-pre-reservation-form') }}">Guest House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-staffhouse-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" style="margin-right:5px;"  href="{{ url('/client/view-staffhouse-pre-reservation-form') }}">Staff House</a>
                    <a class="btn btn-nav h-9 Montserrat {{ Request::is('client/view-DFTC-room-pre-reservation-form') || Request::is('client/view-DFTC-hall-pre-reservation-form') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('client/view-DFTC-room-pre-reservation-form') }}">DFTC</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="width:80%;"data-aos="fade-up" data-aos-duration="800">
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
        <div class="row" data-aos="fade-up" data-aos-duration="800">
            <div class="col-md-12">
                <p class="Montserrat font-extrabold textGradient text-left text-3xl sm:text-4xl md:text-5xl lg:text-6xl h-12 sm:h-14 md:h-16 lg:h-20">STAFF HOUSE</p>
                <p class="Montserrat text-md font-bold textGradient text-center ">PRE-BOOKING </p>
            </div>
        </div>
    </div>
</div>
<div class="container z-1 mt-3 mb-4 d-flex flex-column justify-content-center align-items-center">
    <div class="card bg-light-white lg:w-9/12 md:w-full sm:w-full" data-aos="fade-up" data-aos-duration="800">
        <div class="card-body">
            <form id="staffHouse-booking-form">
                @csrf
                <div class="container mx-auto mt-2">
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <h3 class="Montserrat text-xl font-semibold text-light-green">Personal Information</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="fullName" class="Montserrat text-sm font-semibold">Full Name<span class="text-red-600">*</span></label>
                                    <input type="text" class="form-control" name="fullname" id="fullName" style="background-color:#d3d3d3;" placeholder="Please insert your full name here."  value="{{ isset($user['fullname']) ? $user['fullname'] : session('loggedInCustomer')['fullname'] }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label class="Montserrat text-sm font-semibold">Position/Designation<span class="text-red-600">*</span></label>
                                        @php
                                            $position = isset($user['position']) ? $user['position'] : session('loggedInCustomer')['position'] ?? '';
                                            $isReadonly = isset($user['position']) || session('loggedInCustomer')['position'] ? true : false;
                                        @endphp
                                    <select name="position" id="positionStaffHouse" class="form-control @if($isReadonly) readonly-select @endif" style="background-color:#d3d3d3;" @if($isReadonly) readonly required @endif>
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
                                    <input type="text" class="form-control" name="email" id="emailStaffHouse"  style="background-color:#d3d3d3;" placeholder="Please insert your gmail address here." value="{{ isset($user['email']) ? $user['email'] : session('loggedInCustomer')['email'] }}"  required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="homeAddress" class="Montserrat text-sm font-semibold">Home Address<span class="text-red-600">*</span></label>
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
                                    <input type="text" class="form-control" name="contactnumber" id="contactNumber"  style="background-color:#d3d3d3;" placeholder="Please insert your contact number here." value="{{ isset($user['contact']) ? $user['contact'] : session('loggedInCustomer')['contact'] }}" readonly required>
                                </div>
                            </div>
                            <div class="row mb-2" id="letterInputCellStaffHouse" style="display: none;">
                                <div class="col-12">
                                    <div class="form-group text-light-green">
                                        <label for="hasLetter" class="Montserrat text-sm font-semibold">
                                            Do you have the letter approved by the President or Campus Administrator to access services? (Exclusive to students)
                                        </label>
                                        <div class="mt-2">
                                            <label class="Montserrat text-sm font-semibold">
                                                <input type="radio" name="hasLetterStaffHouse" value="Yes"> Yes
                                            </label>
                                            <label class="Montserrat text-sm font-semibold ml-3">
                                                <input type="radio" name="hasLetterStaffHouse" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
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
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2">
                        <div class="row">
                            <div class="col-12 text-center mb-2">
                                <h3 class="Montserrat text-xl font-semibold text-light-green">Duration of Stay</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green mb-1">
                                    <label for="room_number" class="Montserrat text-sm font-semibold">Room Number<span class="text-red-600">*</span> </label>
                                    <select name="room_numberStaffHouse" id="room_numberStaffHouse" class="form-control" @if(isset($data['id'])) readonly required @endif>
                                        @if (isset($data['id']))
                                            <option value="{{ $data['id'] }}">{{ $data['room_number'] }}</option>
                                        @else
                                            <option value="">Select Room</option>
                                            @foreach($roomnumbers as $room)
                                                @if ($room->room_status != 'Occupied' && $room->room_status != 'Under-Renovation' && $room->room_status != 'Unavailable')
                                                    <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group text-light-green">
                                        <label for="numberofDays" class="Montserrat text-sm font-semibold">Number Of Days</label>
                                        <input type="text" class="form-control" name="numberOfDays" id="numberOfDaysStaffHouse" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group text-light-green">
                                        <label for="numberofNights" class="Montserrat text-sm font-semibold">Number Of Nights</label>
                                        <input type="text" class="form-control" name="numberOfNights" id="numberOfNightsStaffHouse" style="background-color:#d3d3d3;" placeholder="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkInDate" class="Montserrat text-sm font-semibold">Check-In Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkInDate" id="checkInDateStaffHouse" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="arrival" class="Montserrat text-sm font-semibold">Time Arrival<span class="text-red-600">(Fixed based on regulations)</span></label>
                                            <input type="time" class="form-control" name="arrival" id="arrivalStaffHouse" style="background-color:#d3d3d3;" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="checkOutDate" class="Montserrat text-sm font-semibold">Check-Out Date<span class="text-red-600">*</span></label>
                                            <input type="date" class="form-control" name="checkOutDate" id="checkOutDateStaffHouse" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="departure" class="Montserrat text-sm font-semibold">Time Departure<span class="text-red-600">(Fixed based on regulations)</span></label>
                                            <input type="time" class="form-control" name="departure" id="departureStaffHouse" style="background-color:#d3d3d3;" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfMale" class="Montserrat text-sm font-semibold">Number of Male<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfMale" id="numOfMaleStaffHouse" placeholder="Type 0 if none" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="numOfFemale" class="Montserrat text-sm font-semibold">Number of Female<span class="text-red-600">*</span></label>
                                            <input type="number" class="form-control" name="numOfFemale" id="numOfFemaleStaffHouse" placeholder="Type 0 if none" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-md border-green-500 p-1 m-2" readonly>
                        <div class="row">
                            <div class="col-12 text-center mb-1">
                                <h3 class="Montserrat text-xl font-semibold text-light-green">Rates and Computation</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="rate" class="Montserrat text-sm font-semibold">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rateStaffHouse" style="background-color:#d3d3d3;" placeholder="0.00" value="{{ isset($data['room_rate']) ? $data['room_rate'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="capacity" class="Montserrat text-sm font-semibold">Room Bed Capacity</label>
                                    <input type="text" class="form-control" name="capacity" id="capacityStaffHouse" style="background-color:#d3d3d3;" placeholder="0" value="{{ isset($data['room_capacity']) ? $data['room_capacity'] : '' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group text-light-green">
                                    <label for="totalAmount"  class="Montserrat text-sm font-semibold">Total Amount</label><br>
                                    <input type="text" class="form-control" name="totalAmount" id="totalAmountStaffHouse" style="background-color:#d3d3d3;" placeholder="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <h3 class="Montserrat text-xl font-semibold text-light-green">Optional References</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group text-light-green">
                                            <label for="bedding" class="Montserrat text-sm font-semibold">Additional Bedding <span class="">(200 pesos per bedding)</span></label><br>
                                            <input type="number" class="form-control" name="bedding" id="beddingStaffHouse" placeholder="Optional" value="0" min="0" max="3">
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none d-md-block">
                                    <div class="col-md-12 mb-2">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2 mt-1">
                                            <div class="form-group text-light-green">
                                                <label for="bedding" class="Montserrat text-sm font-semibold">Special Request</label><br>
                                                <textarea class="form-control"  name="specialRequests" id="specialRequestsStaffHouse" cols="5" rows="5" placeholder="Please enter your special request here(Optional)""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row">
                                        <div class="col-md-12 text-center mb-2">
                                            <h3 class="Montserrat text-xl font-semibold text-light-green">Mode of Payment</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group text-light-green">
                                                <label for="paymentmethod" class="Montserrat text-sm font-semibold">Payment Method<span class="text-red-600">*</span></label><br>
                                                <select name="payment" id="payment" class="form-control" required>
                                                    <option value="">Select Payment Method</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Salary Deduction">Salary Deduction</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-2 rounded-md border-green-500 p-1 m-2">
                                    <div class="row">
                                        <div class="col-md-12 text-center mb-2">
                                            <h3 class="Montserrat text-xl font-semibold text-light-green">Additional Information</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-light-green">
                                                <label class="Montserrat text-sm font-semibold">Name of Guest/s (Male)</label>
                                                <div id="maleGuestsContainerStaffHouse" class="dynamic-input-container">
                                                    <!-- Dynamic textboxes will appear here -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group text-light-green">
                                                <label class="Montserrat text-sm font-semibold">Name of Guest/s (Female)</label>
                                                <div id="femaleGuestsContainerStaffHouse" class="dynamic-input-container">
                                                    <!-- Female textboxes will dynamically appear here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="error-messageStaffHouse" class="alert alert-danger mt-2" style="display: none;">

                    </div>
                    <div class="row my-2">
                        <div class="col-12 text-right my-2">
                            <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-toggle="modal" data-bs-target="#staffHouseTerms">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Terms and Conditions for Staff House Modal -->
<div class="modal modal-lg fade" id="staffHouseTerms" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light-green">
                <h1 class="modal-title Montserrat text-white font-semibold fs-5">REQUEST FOR ACCOMMODATION</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBodyPreBookStaffHouse" style="max-height: 400px; overflow-y: auto;">
                <p class="Montserrat text-md font-bold font">CONTRACT AND GUIDELINES FOR LODGING AT THE STAFF HOUSE</p>
                <p class="Montserrat text-sm font-semibold text-justify">1. Request for accommodation at the Staff House shall be made by filling up the required contract form to be secured at the Office of the ASP. THIS CONTRACT SHALL BE FILLED TWO (2) WEEKS AHEAD OF TIME OF ARRIVAL TO AVOID CONFLICT OF SCHEDULE. In certain cases, if any scheduled activity and accommodation overlap with the activity and accommodation for visitors of the University, the best interest of NVSU will be given priority.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">2. The cleanliness and orderliness of the room/s before and after use shall be observed by the contracting party/group concerned.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">3. SMOKING IS NOT ALLOWED INSIDE AND OUTSIDE THE STAFF HOUSE. Likewise,the SALE, USE, and POSSESSION of any PROHIBITED DRUGS within the premises of the building shall be STRICTLY FORBIDDEN. DRINKING LIQUOR is discouraged. However, during special events and occasions, intoxicating drink may be allowed but must be strictly controlled and regulated. GAMBLING is also prohibited.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">4. Any Staff House property lost shall be paid with the corresponding amount or if found to be destroyed and unfit for use as the case may be shall be replaced immediately with the same value by the responsible party.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">5. The guest/s is/are requested to observe hte house rules especially the <b>curfew hour of 10:00 in the evening.</b></p><br>
                <p class="Montserrat text-sm font-semibold text-justify">6. Only registered guest/s is/are allowed to use the facilities including telephone, comfort rooms, and other fixtures of the Staff House. Visitor/s of guest/s is/are not allowed to enter the room of said guest/s.</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">7. The use of cooking equipment and materials shall be requested before use. The charge is P150.00 per day per room</p><br>
                <p class="Montserrat text-sm font-semibold text-justify">8. Loss of personal belongings shall not be the responsibility of the University</p>
            </div>
            <div class="modal-footer bg-light-green">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mr-1" id="checkboxContainerPreBookStaffHouse" style="display: none;">
                                <div class="d-flex align-items-start">
                                    <input class="form-check-input mr-1" type="checkbox" value="" id="flexCheckDefaultStaffHouse">
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
                    <button type="button" id="submitButtonStaffHouse" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('modalBodyPreBookStaffHouse').addEventListener('scroll', function() {
        const scrollable = this.scrollHeight - this.clientHeight;

        if (Math.ceil(this.scrollTop) >= scrollable - 10) {
            document.getElementById('checkboxContainerPreBookStaffHouse').style.display = 'block';
        }
    });
document.addEventListener('DOMContentLoaded', function () {
    const numOfMaleInput = document.getElementById('numOfMaleStaffHouse');
    const maleGuestsContainer = document.getElementById('maleGuestsContainerStaffHouse');

    numOfMaleInput.addEventListener('input', function () {
        let numOfMales = parseInt(numOfMaleInput.value, 10);
        if (isNaN(numOfMales) || numOfMales < 0) {
        numOfMales = 0;
        } else if (numOfMales > 8) {
        numOfMales = 8;
        numOfMaleInput.value = numOfMales;
        }
        maleGuestsContainer.innerHTML = '';
        for (let i = 0; i < numOfMales; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'maleGuests[]';
        input.className = 'form-control';
        input.placeholder = `Guest ${i + 1}`;
        maleGuestsContainer.appendChild(input);
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const numOfFemaleInput = document.getElementById('numOfFemaleStaffHouse');
    const femaleGuestsContainer = document.getElementById('femaleGuestsContainerStaffHouse');

    numOfFemaleInput.addEventListener('input', function () {
        let numOfFemales = parseInt(numOfFemaleInput.value, 10);


        if (isNaN(numOfFemales) || numOfFemales < 0) {
            numOfFemales = 0;
        } else if (numOfFemales > 8) {
            numOfFemales = 8;
            numOfFemaleInput.value = numOfFemales;
        }


        femaleGuestsContainer.innerHTML = '';

        for (let i = 0; i < numOfFemales; i++) {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'femaleGuests[]';
            input.className = 'form-control';
            input.placeholder = `Guest ${i + 1}`;
            femaleGuestsContainer.appendChild(input);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const numOfMalesInput = document.getElementById('numOfMaleStaffHouse');
    const numOfFemalesInput = document.getElementById('numOfFemaleStaffHouse');
    const maleGuestsContainer = document.getElementById('maleGuestsContainerStaffHouse');
    const femaleGuestsContainer = document.getElementById('femaleGuestsContainerStaffHouse');

        numOfMalesInput.addEventListener('input', function () {
        let numOfMales = parseInt(numOfMalesInput.value, 10);

        if (isNaN(numOfMales) || numOfMales < 0) numOfMales = 0;

        maleGuestsContainer.innerHTML = '';

        for (let i = 0; i < numOfMales; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'maleGuests[]';
        input.className = 'form-control';
        input.placeholder = `Guest ${i + 1}`;
        maleGuestsContainer.appendChild(input);
        }
    });


    numOfFemalesInput.addEventListener('input', function () {
        let numOfFemales = parseInt(numOfFemalesInput.value, 10);

        if (isNaN(numOfFemales) || numOfFemales < 0) numOfFemales = 0;

        femaleGuestsContainer.innerHTML = '';

        for (let i = 0; i < numOfFemales; i++) {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'femaleGuests[]';
        input.className = 'form-control';
        input.placeholder = `Guest ${i + 1}`;
        femaleGuestsContainer.appendChild(input);
        }
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
       const arrivalInput = document.getElementById("arrivalStaffHouse");
       const departureInput = document.getElementById("departureStaffHouse");

       // Automatically set the fixed times
       arrivalInput.value = "14:00";
       departureInput.value = "12:00";
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
document.getElementById('beddingStaffHouse').addEventListener('input', function (e) {
        const input = e.target;
        const min = parseInt(input.min, 10);
        const max = parseInt(input.max, 10);
        let value = parseInt(input.value, 10);

        // Adjust value if it's out of range
        if (value < min) {
            input.value = min;
        } else if (value > max) {
            input.value = max;
        }
    });
    const roomNumberSelect = document.getElementById('room_numberStaffHouse');
    const checkInDate = document.getElementById('checkInDateStaffHouse');
    const checkOutDate = document.getElementById('checkOutDateStaffHouse');
    const numOfMale = document.getElementById('numOfMaleStaffHouse');
    const numOfFemale = document.getElementById('numOfFemaleStaffHouse');

    function toggleFields() {
        const isRoomSelected = roomNumberSelect.value !== '';
        checkInDate.disabled = !isRoomSelected;
        numOfMale.disabled = !isRoomSelected;
        numOfFemale.disabled = !isRoomSelected;
    }
    roomNumberSelect.addEventListener('change', toggleFields);
    toggleFields();
</script>
<script src="{{ url('js/client/booking-staffhouse/payment.js') }}"></script>
@endsection
