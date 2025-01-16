function viewDftcBookingAdminDftc(booking){
    var data = JSON.parse(booking);
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameDftcHall-modal').text(data.fullname);
    $('#emailDftcHall-modal').text(data.email);
    $('#contactDftcHall-modal').text(data.contact);
    $('#homeAddressDftcHall-modal').text(data.address);
    $('#positionDftcHall-modal').text(data.position);
    $('#agencyDftcHall-modal').text(data.agency);
    $('#datetimeFilledUpDftcHall-modal').text(data.DFTC_date);
    $('#bookingNumberDftcHall-modal').text(data.DFTC_number);
    $('#activityDftcHall-modal').text(data.activity);
    $('#roomNumberDftcHall-modal').text(data.room_number);
    $('#checkInDateDftcHall-modal').text(data.check_in_date);
    $('#checkOutDateDftcHall-modal').text(data.check_out_date);
    $('#numOfDaysDftcHall-modal').text(data.number_of_days);
    $('#numOfNightsDftcHall-modal').text(data.number_of_nights);
    $('#arrivalDftcHall-modal').text(data.arrival);
    $('#departureDftcHall-modal').text(data.departure);
    $('#numOfMalesDftcHall-modal').text(data.num_of_male);
    $('#numOfFemalesDftcHall-modal').text(data.num_of_female);
    $('#rateDftcHall-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountDftcHall-modal').text('FREE');
    }else{
        $('#totalAmountDftcHall-modal').text(data.total_amount);
    }
    $('#specialRequestDftcHall-modal').text(data.special_request);
    $('#avServicesDftcHall-modal').text(data.av_services);
    $('#jServicesDftcHall-modal').text(data.janitor_services);
    $('#view-DftcHall-modal').modal('show');
}
function viewPendingDftcBookingAdminDftc(data){
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameDftcHall-modal').text(data.fullname);
    $('#emailDftcHall-modal').text(data.email);
    $('#contactDftcHall-modal').text(data.contact);
    $('#homeAddressDftcHall-modal').text(data.address);
    $('#positionDftcHall-modal').text(data.position);
    $('#agencyDftcHall-modal').text(data.agency);
    $('#datetimeFilledUpDftcHall-modal').text(data.DFTC_date);
    $('#bookingNumberDftcHall-modal').text(data.DFTC_number);
    $('#activityDftcHall-modal').text(data.activity);
    $('#roomNumberDftcHall-modal').text(data.room_number);
    $('#checkInDateDftcHall-modal').text(data.check_in_date);
    $('#checkOutDateDftcHall-modal').text(data.check_out_date);
    $('#numOfDaysDftcHall-modal').text(data.number_of_days);
    $('#numOfNightsDftcHall-modal').text(data.number_of_nights);
    $('#arrivalDftcHall-modal').text(data.arrival);
    $('#departureDftcHall-modal').text(data.departure);
    $('#numOfMalesDftcHall-modal').text(data.num_of_male);
    $('#numOfFemalesDftcHall-modal').text(data.num_of_female);
    $('#rateDftcHall-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountDftcHall-modal').text('FREE');
    }else{
        $('#totalAmountDftcHall-modal').text(data.total_amount);
    }
    $('#specialRequestDftcHall-modal').text(data.special_request);
    $('#avServicesDftcHall-modal').text(data.av_services);
    $('#jServicesDftcHall-modal').text(data.janitor_services);
    $('#view-DftcHall-modal').modal('show');
}
function reviewDftcBookingAdmin(data){
    $('#booking_status_id').val(data.id);
    $('#room_status_id').val(data.room_id);
    $('#reviewModal').modal('show');
}
function checkDftcBookingAdminDFTC(booking) {
    var data = JSON.parse(booking);

    // Function to convert date from "December 17, 2024" to "17/12/2024"
    function formatDateToDDMMYYYY(dateStr) {
        const date = new Date(dateStr);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        return `${day}/${month}/${year}`;
    }
    $('#room_check_id').val(data.room_id);
    $('#booking_check_id').val(data.id);
    $('#originalDate').val(data.check_out_date);
    $('#originalCheckIn').val(formatDateToDDMMYYYY(data.check_in_date));
    $('#originalCheckoutDate').val(formatDateToDDMMYYYY(data.check_out_date));
    $('#checkModal').modal('show');
}
$(document).ready(function(){
    $(document).on('submit', '#status-clientbooking-form', function(event){
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: 'adminDftcStatusClientBooking',
            data: $(this).serialize(),
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we process your review.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not change status at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                    var errorMessages = Object.values(response.message).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration validation failed!',
                        html: errorMessages,
                        showConfirmButton: true,
                    })
                }else if(response == 404){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Changes were made on the client side therefore, the webpage needs to be refreshed.",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                    });
                }else{
                    Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "DFTC pre-reservation successfully changed status!",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                    });
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
$(document).ready(function(){
    $(document).on('submit', '#check-clientbooking-form', function(event){
        event.preventDefault();
        var id = $('#booking_check_id').val();
        console.log(id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/adminDftcCheckClientBooking',
            data: $(this).serialize(),
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we process your review.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not change status at this time!",
                        showConfirmButton: true,
                    })
                }else if(response == 404){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Changes were made on the client side therefore, the webpage needs to be refreshed.",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                    });
                }else if(response == 200){
                    Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "Successfully added remarks!",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                    });
                }else if(response == 400){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Current date must be within the check-in and check-out date range!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "An error occurred while trying to check out the pre-reservation.",
                        showConfirmButton: true,
                    })
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
