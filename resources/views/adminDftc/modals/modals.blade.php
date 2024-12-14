<div class="modal fade" id="view-room-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">View Room Information</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container  border-4 rounded-md border-green-600">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Room Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Facility Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="facilityName-modal">Guest House</p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="roomName-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Type</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="roomType-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Status</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="roomStatus-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Capacity</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="roomCapacity-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Rate</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="roomRate-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Description</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <textarea class="form-control" id="roomDescription-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Amenities</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <textarea class="form-control" id="roomAmenities-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Inclusions</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <textarea class="form-control" id="roomInclusion-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Photo 1</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <img id="roomPhoto1-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Photo 2</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <img id="roomPhoto2-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Photo 3</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <img id="roomPhoto3-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-room-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Delete Room Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="delete-room-form">
                                @csrf
                                <table class="table table-borderless mx-auto"
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Room ID</label>
                                                    <input type="text" class="form-control" name="room_id" id="roomId" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Warning! Are you sure you want to delete this room?
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
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </div>
            </form>
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
                <div class="container border-4 rounded-md border-green-600">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="fullNameStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4  my-1">
                                    <p id="emailStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="contactStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="homeAddressStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="positionStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="agencyStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2  my-1">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4  my-1">
                                    <p id="datetimeFilledUpStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2  my-1">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4  my-1">
                                    <p id="bookingNumberStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p colspan="1" class="h6">Activity</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="activityStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="roomNumberStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="checkInDateStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="checkOutDateStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="numOfDaysStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="numOfNightsStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="arrivalStaffHouse-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="departureStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="numOfMalesStaffHouse-modal"></p>
                                 </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="numOfFemalesStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Additional Bedding</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="beddingStaffHouse-modal"></p>
                                 </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Mode of Payment</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="paymentStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 my-1">
                                    <p colspan="3" id="specialRequestStaffHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Additional Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Name of Male Guest(s)</p>
                                </div>
                                <div class="col-md-10 my-1">
                                    <textarea class="form-control" id="maleStaffHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Name of Female Guest(s)</p>
                                </div>
                                <div class="col-md-10 my-1">
                                    <textarea class="form-control" id="femaleStaffHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row bg-gray-100 my-2">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="rateStaffHouse-modal"></p>                              
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 my-1">
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
<div class="modal fade" id="cancel-guesthousebooking-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Cancelation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="cancel-guesthouse-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Booking ID</label>
                                                    <input type="text" class="form-control" name="booking_id" id="GH_bookingID" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="reason">Reason</label>
                                                    <select name="reason" id="reason" class="form-control">
                                                        <option value="I've changed my mind.">I've changed my mind</option>
                                                        <option value="No longer needed.">No longer needed</option>
                                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                                        <option value="Event rescheduled.">Event rescheduled</option>
                                                        <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                        <option value="Event canceled.">Event canceled</option>
                                                        <option value="Family emergency.">Family emergency</option>
                                                        <option value="Double pre-reservation.">Double pre-reservation</option>
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
                        <div class="col-md-12">
                            <div class="scrollable-table-container">
                                <table class="table table-striped table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Account Information
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Full Name</td>
                                            <td id="fullNameStaffHouse-modal"></td>
                                            <td class="h6">Email</td>
                                            <td id="emailStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Contact</td>
                                            <td id="contactStaffHouse-modal"></td>
                                            <td class="h6">Home Address</td>
                                            <td id="homeAddressStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Position</td>
                                            <td id="positionStaffHouse-modal"></td>
                                            <td class="h6">Agency</td>
                                            <td id="agencyStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Booking Information
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Date/Time Filled Up</td>
                                            <td id="datetimeFilledUpStaffHouse-modal"></td>
                                            <td class="h6">Booking Number</td>
                                            <td id="bookingNumberStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Activity</td>
                                            <td colspan="3" id="activityStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Room Name/Number</td>
                                            <td colspan="3" id="roomNumberStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Check In Date</td>
                                            <td id="checkInDateStaffHouse-modal"></td>
                                            <td class="h6">Check Out Date</td>
                                            <td id="checkOutDateStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Day(s)</td>
                                            <td id="numOfDaysStaffHouse-modal"></td>
                                            <td class="h6">Number of Night(s)</td>
                                            <td id="numOfNightsStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Time Arrival</td>
                                            <td id="arrivalStaffHouse-modal"></td>
                                            <td class="h6">Time Departure</td>
                                            <td id="departureStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Male(s)</td>
                                            <td id="numOfMalesStaffHouse-modal"></td>
                                            <td class="h6">Number of Female(s)</td>
                                            <td id="numOfFemalesStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Optional Preferences
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Additional Bedding</td>
                                            <td id="beddingStaffHouse-modal"></td>
                                            <td class="h6">Mode of Payment</td>
                                            <td id="paymentStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Special Request</td>
                                            <td colspan="3" id="specialRequestStaffHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Additional Information
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Name of Male Guest(s)</td>
                                            <td colspan="3"><textarea class="form-control" id="maleStaffHouse-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Name of Female Guest(s)</td>
                                            <td colspan="3"><textarea class="form-control" id="femaleStaffHouse-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Rates and Computation
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Rate</td>
                                            <td id="rateStaffHouse-modal"></td>
                                            <td class="h6">Total Amount</td>
                                            <td id="totalAmountStaffHouse-modal"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancel-staffhousebooking-modal">
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
                            <form id="cancel-staffhouse-form">
                                @csrf
                                <table class="table table-borderless mx-auto">
                                    <tbody>
                                        <tr hidden>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="room_id">Booking ID</label>
                                                    <input type="text" class="form-control" name="booking_id" id="SH_bookingID" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="Montserrat text-sm font-semibold">
                                                <div class="form-group text-light-green">
                                                    <label for="reason">Reason</label>
                                                    <select name="reason" id="reason" class="form-control">
                                                        <option value="I've changed my mind.">I've changed my mind</option>
                                                        <option value="No longer needed.">No longer needed</option>
                                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                                        <option value="Event rescheduled.">Event rescheduled</option>
                                                        <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                        <option value="Event canceled.">Event canceled</option>
                                                        <option value="Family emergency.">Family emergency</option>
                                                        <option value="Double pre-reservation.">Double pre-reservation</option>
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
<div class="modal fade" id="view-DftcRoom-modal" >
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
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="fullNameDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="emailDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="contactDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="homeAddressDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="positionDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="agencyDftcRoom-modal"></p>                                
                                </div>
                            </div>
                            <!-- Booking Information -->
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="datetimeFilledUpDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-1">    
                                    <p id="bookingNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">                                
                                    <p colspan="1" class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="activityDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">                                
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-1">
                                    <p colspan="3" id="roomNumberDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-1">                                            
                                    <p id="checkInDateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="checkOutDateDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfDaysDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfNightsDftcRoom-modal"></p>                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="arrivalDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="departureDftcRoom-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="numOfMalesDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                    <div class="col-md-4 mb-1">
                                <p id="numOfFemalesDftcRoom-modal"></p>
                                </div>
                            </div>
                            <!-- Optional Preferences -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                        Optional Preferences
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-1"> 
                                    <p colspan="3" id="specialRequestDftcRoom-modal"></p>
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="rateDftcRoom-modal"></p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p id="totalAmountDftcRoom-modal"></p>
                                </div>
                            </div>
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
                            <div class="row bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Account Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="fullNameDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4">
                                    <p id="emailDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row  bg-gray-100 ">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="contactDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="homeAddressDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="positionDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="agencyDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Booking Information
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="datetimeFilledUpDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="bookingNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="activityDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p colspan="1" class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="roomNumberDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkInDateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkOutDateDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfDaysDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfNightsDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="arrivalDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="departureDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfMalesDftcHall-modal"></p>                                            
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfFemalesDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row mb-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Optional Preferences
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p colspan="3" id="specialRequestDftcHall-modal"></p>
                                </div>
                            </div>
                            <div class="row mb-2 bg-gray-100 ">
                                <div class="Montserrat text-xl font-semibold text-light-green text-center">
                                    Rates and Computation
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Janitor Services</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="janitorServices-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">AV Services</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="avServices-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="rateDftcHall-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-2">
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
                                                            <option value="Event rescheduled.">Event rescheduled</option>
                                                            <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                            <option value="Event canceled.">Event canceled</option>
                                                            <option value="Family emergency.">Family emergency</option>
                                                            <option value="Double pre-reservation.">Double pre-reservation</option>
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
                                                    <select name="reason" id="reason" class="form-control">
                                                        <option value="I've changed my mind.">I've changed my mind</option>
                                                        <option value="No longer needed.">No longer needed</option>
                                                        <option value="Conflict of schedule.">Conflict of schedule</option>
                                                        <option value="Event rescheduled.">Event rescheduled</option>
                                                        <option value="Unexpected work commitments.">Unexpected work commitments</option>
                                                        <option value="Event canceled.">Event canceled</option>
                                                        <option value="Family emergency.">Family emergency</option>
                                                        <option value="Double pre-reservation.">Double pre-reservation</option>
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
                        </div>
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
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
                                <div class="col-md-2 my-1">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="fullNameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Email</p>
                                </div>            
                                <div class="col-md-4 my-1">
                                    <p id="emailAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Username</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="usernameAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="contactAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-10 my-1">
                                    <p id="homeAddressAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 my-1"> 
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 my-1"> 
                                    <p id="positionAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Institution</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="institutionAccount-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100">
                                <div class="col-md-2 my-1">
                                    <p class="h6">Status</p>
                                </div>
                                <div class="col-md-4 my-1">
                                    <p id="statusAccount-modal"></p>
                                </div>
                                <div class="col-md-2 my-1">
                                    <p class="h6">Role</p>
                                </div>
                                <div class="col-md-4 my-1">
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
                    <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Edit Account Form</h1>
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
    <div class="modal fade" id="view-guesthousebooking-modal" >
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
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                    Account Information
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Full Name</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="fullNameGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Email</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="emailGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Contact</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="contactGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Home Address</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="homeAddressGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Position</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="positionGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Agency</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="agencyGuestHouse-modal"></p>
                                </div>
                            </div>                            
                            <!-- Booking Information -->
                            <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Booking Information
                                </div>
                            </div>
                            <div class="row  py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Date/Time Filled Up</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="datetimeFilledUpGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6 mb-2">Booking Number</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p class="" id="bookingNumberGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100 py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Activity</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="activityGuestHouse-modal"></p>
                                </div>                                
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Room Name/Number</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="roomNumberGuestHouse-modal"></p>
                                </div>                                
                            </div>
                            <div class="row bg-gray-100 py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check In Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="checkInDateGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Check Out Date</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                <p id="checkOutDateGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Day(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfDaysGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                        <p class="h6">Number of Night(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfNightsGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Arrival</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="arrivalGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Time Departure</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="departureGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Male(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfMalesGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Number of Female(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="numOfFemalesGuestHouse-modal"></p>
                                </div>
                            </div>
                             <!-- Optional Preferences -->
                             <div class="row">
                                <div class=" bg-gray-100 text-light-green text-center text-xl font-semibold py-2">
                                        Optional Preferences
                                </div>
                            </div>
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Additional Bedding</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="beddingGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Videoke Rent</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="rentGuestHouse-modal"></p>
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Special Request</p>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <p id="specialRequestGuestHouse-modal"></p>
                                </div>
                            </div>
                             <!-- Additional Information -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Additional Information
                                </div>
                            </div>
                            <div class="row bg-gray-100  py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Name of Male Guest(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <textarea class="form-control" id="maleGuestHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Name of Female Guest(s)</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <textarea class="form-control" id="femaleGuestHouse-modal" cols="5" rows="5" readonly></textarea>
                                </div>
                            </div>
                            <!-- Rates and Computation -->
                            <div class="row">
                                <div class="text-light-green text-center text-xl font-semibold py-2">
                                    Rates and Computation
                                </div>
                            </div>  
                            <div class="row py-1 border-top border-bottom">
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Rate</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="rateGuestHouse-modal"></p>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <p class="h6">Total Amount</p>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p id="totalAmountGuestHouse-modal"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

