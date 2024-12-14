function viewGuestHousePreBookings(roomId) {
    $.ajax({
        url: '/superAdmin/getGuestHousePreBookingsDetails',
        type: 'GET',
        data: { room_id: roomId },
        success: function(response) {
            let bookingsArray = response.bookingsArray;
            if(response.error){
                alert(response.error);
            }else if(bookingsArray.length <= 0){
                $('#noneguesthouse-prebooking-modal').modal('show');
            }else{
                let GH_numbers = response.GH_numbers;
                let checkin_dates = response.checkin_dates;
                let checkout_dates = response.checkout_dates;
                let departures = response.departures;
                let bookingDetailsHtml = '';
                for (let i = 0; i < GH_numbers.length; i++) {
                    bookingDetailsHtml += `
                       <div class="row booking-row">
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                         <p>${i + 1}. Guest House Number: ${GH_numbers[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check In Date: ${checkin_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check Out Date: ${checkout_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Departure Time: ${departures[i]}</p>
                    </div>
                </div>
                    <hr>
                    `;
                }
            document.getElementById('bookingDetailsContainerGuestHouse').innerHTML = bookingDetailsHtml;
            $('#guesthouse-prebooking-modal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            $('#noneguesthouse-prebooking-modal').modal('show');
        }
    });
}
function viewStaffHousePreBookings(roomId){
    $.ajax({
        url: '/superAdmin/getStaffHousePreBookingsDetails',
        type: 'GET',
        data: { room_id: roomId },
        success: function(response) {
            let bookingsArray = response.bookingsArray;
            if(response.error){
                alert(response.error);
            }else if(bookingsArray.length <= 0){
                $('#nonestaffhouse-prebookings-modal').modal('show');
            }else{
                let SH_numbers = response.SH_numbers;
                let checkin_dates = response.checkin_dates;
                let checkout_dates = response.checkout_dates;
                let departures = response.departures;
                let bookingDetailsHtml = '';
                for (let i = 0; i < SH_numbers.length; i++) {
                    bookingDetailsHtml += `
                       <div class="row booking-row">
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                         <p>${i + 1}. Staff House Number: ${SH_numbers[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check In Date: ${checkin_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check Out Date: ${checkout_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Departure Time: ${departures[i]}</p>
                    </div>
                </div>
                    <hr>
                    `;
                }
            document.getElementById('bookingDetailsContainerStaffHouse').innerHTML = bookingDetailsHtml;
            $('#staffhouse-prebookings-modal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            $('#nonestaffhouse-prebookings-modal').modal('show');
        }
    });
}
function viewDftcRoomPreBookings(roomId){
    $.ajax({
        url: '/superAdmin/getDftcRoomPreBookingsDetails',
        type: 'GET',
        data: { room_id: roomId },
        success: function(response) {
            let bookingsArray = response.bookingsArray;
            if(response.error){
                alert(response.error);
            }else if(bookingsArray.length <= 0){
                $('#nonedftc-prebookings-modal').modal('show');
            }else{
                let DFTC_numbers = response.DFTC_numbers;
                let checkin_dates = response.checkin_dates;
                let checkout_dates = response.checkout_dates;
                let departures = response.departures;
                let bookingDetailsHtml = '';
                for (let i = 0; i < DFTC_numbers.length; i++) {
                    bookingDetailsHtml += `
                       <div class="row booking-row">
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                         <p>${i + 1}. DFTC Number: ${DFTC_numbers[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check In Date: ${checkin_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check Out Date: ${checkout_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Departure Time: ${departures[i]}</p>
                    </div>
                </div>
                    <hr>
                    `;
                }
            document.getElementById('bookingDetailsContainerDFTC').innerHTML = bookingDetailsHtml;
            $('#dftcroom-prebookings-modal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            $('#nonedftc-prebookings-modal').modal('show');
        }
    });
}
function viewDftcHallPreBookings(roomId){
    $.ajax({
        url: '/superAdmin/getDftcHallPreBookingsDetails',
        type: 'GET',
        data: { room_id: roomId },
        success: function(response) {
            let bookingsArray = response.bookingsArray;
            if(response.error){
                alert(response.error);
            }else if(bookingsArray.length <= 0){
                $('#nonedftchall-prebookings-modal').modal('show');
            }else{
                let DFTC_numbers = response.DFTC_numbers;
                let checkin_dates = response.checkin_dates;
                let checkout_dates = response.checkout_dates;
                let departures = response.departures;
                let bookingDetailsHtml = '';
                for (let i = 0; i < DFTC_numbers.length; i++) {
                    bookingDetailsHtml += `
                       <div class="row booking-row">
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                         <p>${i + 1}. DFTC Number: ${DFTC_numbers[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check In Date: ${checkin_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Check Out Date: ${checkout_dates[i]}</p>
                    </div>
                    <div class="col-md-3 Montserrat text-sm font-semibold text-light-green">
                        <p>Departure Time: ${departures[i]}</p>
                    </div>
                </div>
                    <hr>
                    `;
                }
            document.getElementById('bookingDetailsContainerDftchall').innerHTML = bookingDetailsHtml;
            $('#dftchall-prebookings-modal').modal('show');
            }
        },
        error: function(xhr, status, error) {
            $('#nonedftchall-prebookings-modal').modal('show');
        }
    });
}
