@extends('main/layout')

@section('content')
<br><br>
<div class="container d-flex justify-content-center m-2">
    <div class="row align-items-center m-1" data-aos="fade-up" data-aos-duration="800">
        <div class="col-md-12">
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('guestHouseBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('guestHouseBook') }}">Guest House</a>
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('staffHouseBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('staffHouseBook') }}">Staff House</a>
            <a class="btn btn-nav h-9 Montserrat {{ Request::is('dftcBook') ? 'bg-light-green text-dark-white' : 'inactive' }}" href="{{ url('dftcBook') }}">DFTC</a>
        </div>
    </div>
</div>

<div class="container d-flex justify-content-center">
    <div class="card w-9/12 bg-light-white" data-aos="fade-up" data-aos-duration="800">
        <div class="card-body">
            <form id="staffHouse-booking-form">
                            @csrf
                            <table class="table table-borderless mx-auto"
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
                                                <select name="position" id="positionStaffHouse" class="form-control" readonly>
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
                                                <input type="text" class="form-control" name="email" id="emailStaffHouse" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="Montserrat text-sm font-semibold" id="letterInputCellStaffHouse" style="display: none;">
                                            <div id="letterInput" class="form-group text-light-green">
                                                <label for="hasLetter">Attached Letter of Approval to be submitted to the President to avail free services (Applicable for students only)</label>
                                                <select name="hasLetter" id="hasLetterStaffHouse" class="form-control">
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
                                                <input type="text" class="form-control" name="contactnumber" id="contactNumber"  readonly>
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
                                                <select name="room_numberStaffHouse" id="room_numberStaffHouse" class="form-control" @if(isset($data['id'])) readonly @endif>
                                                    <option value="">Select Room</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="numberofDays">Number Of Days</label>
                                                <input type="text" class="form-control" name="numberOfDays" id="numberOfDaysStaffHouse" readonly>
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="numberofNights">Number Of Nights</label>
                                                <input type="text" class="form-control" name="numberOfNights" id="numberOfNightsStaffHouse" readonly>
                                            </div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="checkInDate">Check-In Date</label>
                                                <input type="date" class="form-control" name="checkInDate" id="checkInDateStaffHouse">
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="arrival">Time Arrival</label>
                                                <input type="time" class="form-control" name="arrival" id="arrivalStaffHouse">
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="numOfMale">Number of Male</label>
                                                <input type="number" class="form-control" name="numOfMale" id="numOfMaleStaffHouse">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="checkOutDate">Check-Out Date</label>
                                                <input type="date" class="form-control" name="checkOutDate" id="checkOutDateStaffHouse">
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="departure">Time Departure</label>
                                                <input type="time" class="form-control" name="departure" id="departureStaffHouse">
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="numOfFemale">Number of Female</label>
                                                <input type="number" class="form-control" name="numOfFemale" id="numOfFemaleStaffHouse">
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

                                    </tr>
                                    <tr>

                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="rate">Rate</label>
                                                <input type="text" class="form-control" name="rate" id="rateStaffHouse" value="{{ isset($data['room_rate']) ? $data['room_rate'] : '' }}" readonly>
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="capacity">Room Bed Capacity</label>
                                                <input type="text" class="form-control" name="capacity" id="capacityStaffHouse" value="{{ isset($data['room_capacity']) ? $data['room_capacity'] : '' }}" readonly>
                                            </div>
                                        </td>
                                        <td class="Montserrat font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="totalAmount" class="text-sm">Total Amount</label><br>
                                                <input type="text" class="form-control" name="totalAmount" id="totalAmountStaffHouse" readonly>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="Montserrat text-xl font-semibold">
                                            <div class="text-light-green text-center">
                                                Optional Preferences
                                            </div>
                                        </th>
                                        <th colspan="2" class="Montserrat text-xl font-semibold">
                                            <div class="text-light-green text-center">
                                                Mode of Payment
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="Montserrat font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="bedding" class="text-sm">Additional Bedding</label><br>
                                                <input type="text" class="form-control" name="bedding" id="beddingStaffHouse">
                                            </div>
                                        </td>
                                        <td colspan="2" class="Montserrat font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="paymentmethod" class="text-sm">Payment Method</label><br>
                                                <select name="payment" id="payment" class="form-control">
                                                    <option value="">Select Payment Method</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Salary Deduction">Salary Deduction</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="Montserrat text-xl font-semibold">
                                            <div class="text-light-green text-center">
                                                Additional Information
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="Montserrat  text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="maleGuests">Name of Guest/s (Male)</label>
                                                <textarea name="maleGuests" id="maleGuestsStaffHouse" cols="5" rows="5" class="form-control"></textarea>
                                            </div>
                                        </td>
                                        <td class="Montserrat text-sm font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="femaleGuests">Name of Guest/s (Female)</label>
                                                <textarea name="femaleGuests" id="femaleGuestsStaffHouse" cols="5" rows="5" class="form-control"></textarea>
                                            </div>
                                        </td>
                                        <td class="Montserrat font-semibold">
                                            <div class="form-group text-light-green">
                                                <label for="specialRequests">Special Requests</label>
                                                <textarea class="form-control"  name="specialRequests" id="specialRequestsStaffHouse" cols="5" rows="5"></textarea>
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


<!-- Terms and Conditions for Staff House Modal -->
<div class="modal modal-lg fade" id="staffHouseTerms" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-light-green text-center">
            <h1 class="modal-title Montserrat text-white font-semibold fs-5">REQUEST FOR ACCOMMODATION AT THE STAFF HOUSE</h1>
            <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
