<div class="modal fade" id="view-room-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">View Room Information</h1>
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
                                                    Room Information
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Facility Name</td>
                                            <td id="facilityName-modal">Guest House</td>
                                            <td class="h6">Room Name</td>
                                            <td id="roomName-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Type</td>
                                            <td id="roomType-modal"></td>
                                            <td class="h6">Room Status</td>
                                            <td id="roomStatus-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Capacity</td>
                                            <td id="roomCapacity-modal"></td>
                                            <td class="h6">Room Rate</td>
                                            <td id="roomRate-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Description</td>
                                            <td colspan="3"><textarea class="form-control" id="roomDescription-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Amenities</td>
                                            <td colspan="3"><textarea class="form-control" id="roomAmenities-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Inclusions</td>
                                            <td colspan="3"><textarea class="form-control" id="roomInclusion-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Photo 1</td>
                                            <td colspan="3"><img id="roomPhoto1-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Photo 2</td>
                                            <td colspan="3"><img id="roomPhoto2-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Room Photo 3</td>
                                            <td colspan="3"><img id="roomPhoto3-modal" style="width: 100%; height: 400px;" src="" alt="Photo 1"></td>
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
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Client Staff House Pre-Reservation Information</h1>
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
<div class="modal fade" id="cancel-guesthousebooking-modal">
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
                            <form id="cancel-guesthouse-form">
                                @csrf
                                <table class="table table-borderless mx-auto"
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
<div class="modal fade" id="view-staffhousebooking-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Client Staff House Pre-Reservation Information</h1>
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
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Staff House Cancelation Pre-Reservation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="cancel-staffhouse-form">
                                @csrf
                                <table class="table table-borderless mx-auto"
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
<div class="modal fade" id="view-DftcRoom-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Client DFTC Pre-Reservation Information</h1>
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
                                            <td id="fullNameDftcRoom-modal"></td>
                                            <td class="h6">Email</td>
                                            <td id="emailDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Contact</td>
                                            <td id="contactDftcRoom-modal"></td>
                                            <td class="h6">Home Address</td>
                                            <td id="homeAddressDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Position</td>
                                            <td id="positionDftcRoom-modal"></td>
                                            <td class="h6">Agency</td>
                                            <td id="agencyDftcRoom-modal"></td>
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
                                            <td id="datetimeFilledUpDftcRoom-modal"></td>
                                            <td class="h6">Booking Number</td>
                                            <td id="bookingNumberDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Activity</td>
                                            <td colspan="3" id="activityDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Room Name/Number</td>
                                            <td colspan="3" id="roomNumberDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Check In Date</td>
                                            <td id="checkInDateDftcRoom-modal"></td>
                                            <td class="h6">Check Out Date</td>
                                            <td id="checkOutDateDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Day(s)</td>
                                            <td id="numOfDaysDftcRoom-modal"></td>
                                            <td class="h6">Number of Night(s)</td>
                                            <td id="numOfNightsDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Time Arrival</td>
                                            <td id="arrivalDftcRoom-modal"></td>
                                            <td class="h6">Time Departure</td>
                                            <td id="departureDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Male(s)</td>
                                            <td id="numOfMalesDftcRoom-modal"></td>
                                            <td class="h6">Number of Female(s)</td>
                                            <td id="numOfFemalesDftcRoom-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Optional Preferences
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Special Request</td>
                                            <td colspan="3" id="specialRequestDftcRoom-modal"></td>
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
                                            <td id="rateDftcRoom-modal"></td>
                                            <td class="h6">Total Amount</td>
                                            <td id="totalAmountDftcRoom-modal"></td>
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
<div class="modal fade" id="view-DftcHall-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Client DFTC Pre-Reservation Information</h1>
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
                                            <td id="fullNameDftcHall-modal"></td>
                                            <td class="h6">Email</td>
                                            <td id="emailDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Contact</td>
                                            <td id="contactDftcHall-modal"></td>
                                            <td class="h6">Home Address</td>
                                            <td id="homeAddressDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Position</td>
                                            <td id="positionDftcHall-modal"></td>
                                            <td class="h6">Agency</td>
                                            <td id="agencyDftcHall-modal"></td>
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
                                            <td id="datetimeFilledUpDftcHall-modal"></td>
                                            <td class="h6">Booking Number</td>
                                            <td id="bookingNumberDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Activity</td>
                                            <td colspan="3" id="activityDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Room Name/Number</td>
                                            <td colspan="3" id="roomNumberDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Check In Date</td>
                                            <td id="checkInDateDftcHall-modal"></td>
                                            <td class="h6">Check Out Date</td>
                                            <td id="checkOutDateDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Day(s)</td>
                                            <td id="numOfDaysDftcHall-modal"></td>
                                            <td class="h6">Number of Night(s)</td>
                                            <td id="numOfNightsDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Time Arrival</td>
                                            <td id="arrivalDftcHall-modal"></td>
                                            <td class="h6">Time Departure</td>
                                            <td id="departureDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Male(s)</td>
                                            <td id="numOfMalesDftcHall-modal"></td>
                                            <td class="h6">Number of Female(s)</td>
                                            <td id="numOfFemalesDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Optional Preferences
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Special Request</td>
                                            <td colspan="3" id="specialRequestDftcHall-modal"></td>
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
                                            <td id="rateDftcHall-modal"></td>
                                            <td class="h6">Total Amount</td>
                                            <td id="totalAmountDftcHall-modal"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="Montserrat text-xl font-semibold">
                                                <div class="text-light-green text-center">
                                                    Additional Charges
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="h6">Janitorial Services</td>
                                            <td id="jServicesDftcHall-modal"></td>
                                            <td class="h6">AV Tech Services</td>
                                            <td id="avServicesDftcHall-modal"></td>
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
<div class="modal fade" id="cancel-dftcbooking-modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">DFTC Cancelation Pre-Reservation Form</h1>
                <button type="button" class="btn-close text-white bg-lightest-green" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="cancel-dftc-form">
                                @csrf
                                <table class="table table-borderless mx-auto"
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="scrollable-table-container">
                                <table class="table table-striped table-hover table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="h6">Full Name</td>
                                            <td id="fullNameAccount-modal"></td>
                                            <td class="h6">Email</td>
                                            <td id="emailAccount-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Username</td>
                                            <td id="usernameAccount-modal"></td>
                                            <td class="h6">Contact</td>
                                            <td id="contactAccount-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Home Address</td>
                                            <td colspan="3" id="homeAddressAccount-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Position</td>
                                            <td id="positionAccount-modal"></td>
                                            <td class="h6">Institution</td>
                                            <td id="institutionAccount-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Status</td>
                                            <td id="statusAccount-modal"></td>
                                            <td class="h6">Role</td>
                                            <td id="roleAccount-modal"></td>
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
<div class="modal fade" id="view-guesthousebooking-modal" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content" >
            <div class="modal-header bg-light-green">
                <h1 class="modal-title fs-5 Montserrat text-white font-semibold fs-5">Client Guest House Pre-Reservation Information</h1>
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
                                            <td id="fullNameGuestHouse-modal"></td>
                                            <td class="h6">Email</td>
                                            <td id="emailGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Contact</td>
                                            <td id="contactGuestHouse-modal"></td>
                                            <td class="h6">Home Address</td>
                                            <td id="homeAddressGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Position</td>
                                            <td id="positionGuestHouse-modal"></td>
                                            <td class="h6">Agency</td>
                                            <td id="agencyGuestHouse-modal"></td>
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
                                            <td id="datetimeFilledUpGuestHouse-modal"></td>
                                            <td class="h6">Booking Number</td>
                                            <td id="bookingNumberGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Activity</td>
                                            <td colspan="3" id="activityGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" class="h6">Room Name/Number</td>
                                            <td colspan="3" id="roomNumberGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Check In Date</td>
                                            <td id="checkInDateGuestHouse-modal"></td>
                                            <td class="h6">Check Out Date</td>
                                            <td id="checkOutDateGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Day(s)</td>
                                            <td id="numOfDaysGuestHouse-modal"></td>
                                            <td class="h6">Number of Night(s)</td>
                                            <td id="numOfNightsGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Time Arrival</td>
                                            <td id="arrivalGuestHouse-modal"></td>
                                            <td class="h6">Time Departure</td>
                                            <td id="departureGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Number of Male(s)</td>
                                            <td id="numOfMalesGuestHouse-modal"></td>
                                            <td class="h6">Number of Female(s)</td>
                                            <td id="numOfFemalesGuestHouse-modal"></td>
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
                                            <td id="beddingGuestHouse-modal"></td>
                                            <td class="h6">Videoke Rent</td>
                                            <td id="rentGuestHouse-modal"></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Special Request</td>
                                            <td colspan="3" id="specialRequestGuestHouse-modal"></td>
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
                                            <td colspan="3"><textarea class="form-control" id="maleGuestHouse-modal" cols="5" rows="5" readonly></textarea></td>
                                        </tr>
                                        <tr>
                                            <td class="h6">Name of Female Guest(s)</td>
                                            <td colspan="3"><textarea class="form-control" id="femaleGuestHouse-modal" cols="5" rows="5" readonly></textarea></td>
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
                                            <td id="rateGuestHouse-modal"></td>
                                            <td class="h6">Total Amount</td>
                                            <td id="totalAmountGuestHouse-modal"></td>
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
