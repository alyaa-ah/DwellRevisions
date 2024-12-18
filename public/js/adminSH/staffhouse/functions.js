function viewStaffHouseBookingAdminSH(data){
    var data = JSON.parse(data);
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameStaffHouse-modal').text(data.fullname);
    $('#emailStaffHouse-modal').text(data.email);
    $('#contactStaffHouse-modal').text(data.contact);
    $('#homeAddressStaffHouse-modal').text(data.address);
    $('#positionStaffHouse-modal').text(data.position);
    $('#agencyStaffHouse-modal').text(data.agency);
    $('#datetimeFilledUpStaffHouse-modal').text(data.SH_date);
    $('#bookingNumberStaffHouse-modal').text(data.SH_number);
    $('#activityStaffHouse-modal').text(data.activity);
    $('#roomNumberStaffHouse-modal').text(data.room_number);
    $('#checkInDateStaffHouse-modal').text(data.check_in_date);
    $('#checkOutDateStaffHouse-modal').text(data.check_out_date);
    $('#numOfDaysStaffHouse-modal').text(data.number_of_days);
    $('#numOfNightsStaffHouse-modal').text(data.number_of_nights);
    $('#arrivalStaffHouse-modal').text(data.arrival);
    $('#departureStaffHouse-modal').text(data.departure);
    $('#numOfMalesStaffHouse-modal').text(data.num_of_male);
    $('#numOfFemalesStaffHouse-modal').text(data.num_of_female);
    $('#rateStaffHouse-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountStaffHouse-modal').text('FREE');
    }else{
        $('#totalAmountStaffHouse-modal').text(data.total_amount);
    }
    $('#beddingStaffHouse-modal').text(data.additional_bedding);
    $('#paymentStaffHouse-modal').text(data.payment);
    $('#specialRequestStaffHouse-modal').text(data.special_request);
    $('#maleStaffHouse-modal').val(data.male_guest);
    $('#femaleStaffHouse-modal').val(data.female_guest);
    $('#view-staffhousebooking-modal').modal('show');
}
function viewPendingStaffHouseBookingAdminSH(data){
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameStaffHouse-modal').text(data.fullname);
    $('#emailStaffHouse-modal').text(data.email);
    $('#contactStaffHouse-modal').text(data.contact);
    $('#homeAddressStaffHouse-modal').text(data.address);
    $('#positionStaffHouse-modal').text(data.position);
    $('#agencyStaffHouse-modal').text(data.agency);
    $('#datetimeFilledUpStaffHouse-modal').text(data.SH_date);
    $('#bookingNumberStaffHouse-modal').text(data.SH_number);
    $('#activityStaffHouse-modal').text(data.activity);
    $('#roomNumberStaffHouse-modal').text(data.room_number);
    $('#checkInDateStaffHouse-modal').text(data.check_in_date);
    $('#checkOutDateStaffHouse-modal').text(data.check_out_date);
    $('#numOfDaysStaffHouse-modal').text(data.number_of_days);
    $('#numOfNightsStaffHouse-modal').text(data.number_of_nights);
    $('#arrivalStaffHouse-modal').text(data.arrival);
    $('#departureStaffHouse-modal').text(data.departure);
    $('#numOfMalesStaffHouse-modal').text(data.num_of_male);
    $('#numOfFemalesStaffHouse-modal').text(data.num_of_female);
    $('#rateStaffHouse-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountStaffHouse-modal').text('FREE');
    }else{
        $('#totalAmountStaffHouse-modal').text(data.total_amount);
    }
    $('#beddingStaffHouse-modal').text(data.additional_bedding);
    $('#paymentStaffHouse-modal').text(data.payment);
    $('#specialRequestStaffHouse-modal').text(data.special_request);
    $('#maleStaffHouse-modal').val(data.male_guest);
    $('#femaleStaffHouse-modal').val(data.female_guest);
    $('#view-staffhousebooking-modal').modal('show');
}
function reviewStaffHouseBookingAdminSH(data){
    $('#booking_status_id').val(data.id);
    $('#reviewModal').modal('show');
}
function checkStaffHouseBookingAdminSH(booking) {
    var data = JSON.parse(booking);

    // Function to convert date from "December 17, 2024" to "17/12/2024"
    function formatDateToDDMMYYYY(dateStr) {
        const date = new Date(dateStr);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        return `${day}/${month}/${year}`;
    }

    $('#booking_check_id').val(data.id);
    $('#originalDate').val(data.check_out_date);
    $('#originalCheckIn').val(formatDateToDDMMYYYY(data.check_in_date));
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
            url: 'adminSHStatusClientBooking',
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
                }
                else{
                    Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "Staff House pre-reservation successfully changed status!",
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
            url: '/adminSHCheckClientBooking',
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
                        text: "Staff House pre-reservation successfully changed check out!",
                        showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                    });
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
