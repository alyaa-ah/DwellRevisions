@extends('main/layout')

@section('content')
<br><br>
<div class="container d-flex justify-content-center m-2">
    <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
        <div class="col-md-12">
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('guestHouseBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('guestHouseBook') }}">Guest House</a>
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('staffHouseBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('staffHouseBook') }}">Staff House</a>
            <a class="btn btn-nav h-9 Montserrat bg-light-green text-dark-white" href="{{ url('dftcBook') }}">DFTC</a>
        </div>
    </div>
</div>
<div class="container d-flex justify-content-center m-2">
    <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
        <div class="col-md-12">
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('dftcBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('dftcBook') }}">Room</a>
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('dftcHall') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('dftcHall') }}">Hall</a>
        </div>
    </div>
</div>
<div class="container d-flex justify-content-center">
    <div class="card w-9/12 bg-light-white" data-aos="fade-up" data-aos-duration="800">
        <div class="card-body">
            <form id="dftc-booking-form">
                @csrf
                <table class="table table-borderless mx-auto">
                    <tbody>
                        <tr>
                            <th colspan="3" class="Montserrat text-xl font-semibold">
                                <div class="text-light-green text-center">
                                    Personal Information
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullName" readonly>
                                </div>
                            </td>
                            <td class="Montserrat font-semibold">
                                <div class="form-group text-light-green">
                                    <label class="text-sm">Position/Designation</label><br>
                                    <select name="position" id="position" class="form-control" readonly>
                                        <option value="">Select Position/Designation</option>
                                        <option value="Guest">Guest</option>
                                        <option value="Student">Student</option>
                                        <option value="Employee">Employee</option>
                                    </select>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="Email">Email Address</label>
                                    <input type="text" class="form-control" name="email" id="email" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="Montserrat text-sm font-semibold" id="letterInputCell" style="display: none;">
                                <div id="letterInput" class="form-group text-light-green">
                                    <label for="hasLetter">Attached Letter of Approval to be submitted to the President to avail free services (Applicable for students only)</label>
                                    <select name="hasLetter" id="hasLetter" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="homeAddress">Home Address</label>
                                    <input type="text" class="form-control" name="address" id="address" readonly>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="agency">Department/Agency/College</label>
                                    <input type="text" class="form-control" name="agency" id="agency"  readonly>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="contactNumber">Contact Number</label>
                                    <input type="text" class="form-control" name="contactnumber" id="contactNumber" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="activity">Activity</label>
                                    <input type="text" class="form-control" name="activity" id="activity">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" class="Montserrat text-xl font-semibold">
                                <div class="text-light-green text-center">
                                    Duration of Stay
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="room_number">Room Number</label>
                                    <select name="room_number" id="room_numberDftc" class="form-control" readonly >
                                        <option value="">Select Room</option>
                                    </select>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="numberofDays">Number Of Days</label>
                                    <input type="text" class="form-control" name="numberOfDays" id="numberOfDaysDftc" readonly>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="numberofNights">Number Of Nights</label>
                                    <input type="text" class="form-control" name="numberOfNights" id="numberOfNightsDftc" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="checkInDate">Check-In Date</label>
                                    <input type="date" class="form-control" name="checkInDate" id="checkInDateDftc">
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="arrival">Time Arrival</label>
                                    <input type="time" class="form-control" name="arrival" id="arrivalDftc">
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="numOfMale">Number of Male</label>
                                    <input type="number" class="form-control" name="numOfMale" id="numOfMaleDftc">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="checkOutDate">Check-Out Date</label>
                                    <input type="date" class="form-control" name="checkOutDate" id="checkOutDateDftc">
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="departure">Time Departure</label>
                                    <input type="time" class="form-control" name="departure" id="departureDftc">
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="numOfFemale">Number of Female</label>
                                    <input type="number" class="form-control" name="numOfFemale" id="numOfFemaleDftc">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" class="Montserrat text-xl font-semibold">
                                <div class="text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="rate">Rate</label>
                                    <input type="text" class="form-control" name="rate" id="rateHallDftc" value="{{ isset($data['room_rate']) ? $data['room_rate'] : '' }}" readonly>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="capacity">Max Capacity</label>
                                    <input type="text" class="form-control" name="capacity" id="capacityHallDftc" value="{{ isset($data['room_capacity']) ? $data['room_capacity'] : '' }}" readonly >
                                </div>
                            </td>
                            <td class="Montserrat font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="totalAmount" class="text-sm">Total Amount</label><br>
                                    <input type="text" class="form-control" name="totalAmount" id="totalAmountHallDftc" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="1" class="Montserrat text-xl font-semibold">
                                <div class="text-light-green">
                                    Additional Information
                                </div>
                            </th>
                            <th colspan="2" class="Montserrat text-xl font-semibold">
                                <div class="text-light-green text-center">
                                    Additional Charges
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group text-light-green">
                                    <label for="specialRequests">Special Requests</label>
                                    <textarea class="form-control"  name="specialRequests" id="specialRequestsHallDftc" cols="5" rows="5"></textarea>
                                </div>
                            </td>
                            <td class="Montserrat text-sm font-semibold">
                                <div class="form-group  text-sm text-light-green">
                                    <label for="janitorservices">Janitorial Services</label>
                                    <input type="number" name="janitorservices" id="janitorservices" class="form-control" readonly>
                                </div>
                                <div class="form-group  text- text-light-green mt-3">
                                    <label for="holidayrate">Total Weekends/Holidays Rate for Services</label>
                                    <input type="number" name="holiday" id="holidayrate" class="form-control" readonly>
                                </div>
                            </td>
                            <td class="Montserrat font-semibold">
                                <div class="form-group  text-sm text-light-green">
                                    <label for="avservices">AV Services</label>
                                    <input type="number" name="avservices" id="avservices" class="form-control" readonly>
                                </div>
                                <div class="form-group  text-sm text-light-green mt-3">
                                    <label for="timerate">Night Time Rate</label>
                                    <input type="number" name="timerate" id="timerate" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if(session()->has('loggedInCustomer') || session()->has('loggedInSuperAdmin') || session()->has('loggedInAdmin'))
                                    <button type="button" class="btn bg-light-green Montserrat text-white hover:bg-dark-green" data-bs-toggle="modal" data-bs-target="#staffHouseTerms">Submit</button>
                                @else
                                    <h1 class="text-md text-light-green Montserrat font-semibold">Please login to submit</>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<!-- Terms and Conditions for DFTC Modal -->
<div class="modal modal-lg fade" id="dftcTerms" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-light-green text-center">
            <h1 class="modal-title Montserrat text-white font-semibold fs-5">REQUEST FOR THE USE OF DUMLAO FARMERS' TRAINING CENTER (DFTC)</h1>
            <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                    <div class="col text-center">
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-white text-center Montserrat text-sm font-semibold" for="flexCheckDefault">
                                I hereby agree to conform to and abide by the terms and conditions, rules, and regulations.
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <button type="button" class="btn btn-secondary Montserrat" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn bg-medium-green text-white hover:bg-dark-green Montserrat">Submit</button>
            </div>
        </div>
    </div>
  </div>
</div>
<br><br><br><br><br>
@endsection
