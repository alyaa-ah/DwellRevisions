function viewGuestHousePendingBookingAdminGH(data){
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameGuestHouse-modal').text(data.fullname);
    $('#emailGuestHouse-modal').text(data.email);
    $('#contactGuestHouse-modal').text(data.contact);
    $('#homeAddressGuestHouse-modal').text(data.address);
    $('#positionGuestHouse-modal').text(data.position);
    $('#agencyGuestHouse-modal').text(data.agency);
    $('#datetimeFilledUpGuestHouse-modal').text(data.GH_date);
    $('#bookingNumberGuestHouse-modal').text(data.GH_number);
    $('#activityGuestHouse-modal').text(data.activity);
    $('#roomNumberGuestHouse-modal').text(data.room_number);
    $('#checkInDateGuestHouse-modal').text(data.check_in_date);
    $('#checkOutDateGuestHouse-modal').text(data.check_out_date);
    $('#numOfDaysGuestHouse-modal').text(data.number_of_days);
    $('#numOfNightsGuestHouse-modal').text(data.number_of_nights);
    $('#arrivalGuestHouse-modal').text(data.arrival);
    $('#departureGuestHouse-modal').text(data.departure);
    $('#numOfMalesGuestHouse-modal').text(data.num_of_male);
    $('#numOfFemalesGuestHouse-modal').text(data.num_of_female);
    $('#rateGuestHouse-modal').text(data.rate);
    if(total_amount == "0.00" && position == 'Student'){
        $('#totalAmountGuestHouse-modal').text('FREE');
    }else{
        $('#totalAmountGuestHouse-modal').text(total_amount);
    }
    $('#beddingGuestHouse-modal').text(data.additional_bedding);
    $('#rentGuestHouse-modal').text(data.videoke_rent);
    $('#specialRequestGuestHouse-modal').text(data.special_request);
    $('#maleGuestHouse-modal').val(data.male_guest);
    $('#femaleGuestHouse-modal').val(data.female_guest);
    $('#view-guesthousebooking-modal').modal('show');
}
function viewGuestHouseBookingAdminGH(booking){
    var data = JSON.parse(booking);
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameGuestHouse-modal').text(data.fullname);
    $('#emailGuestHouse-modal').text(data.email);
    $('#contactGuestHouse-modal').text(data.contact);
    $('#homeAddressGuestHouse-modal').text(data.address);
    $('#positionGuestHouse-modal').text(data.position);
    $('#agencyGuestHouse-modal').text(data.agency);
    $('#datetimeFilledUpGuestHouse-modal').text(data.GH_date);
    $('#bookingNumberGuestHouse-modal').text(data.GH_number);
    $('#activityGuestHouse-modal').text(data.activity);
    $('#roomNumberGuestHouse-modal').text(data.room_number);
    $('#checkInDateGuestHouse-modal').text(data.check_in_date);
    $('#checkOutDateGuestHouse-modal').text(data.check_out_date);
    $('#numOfDaysGuestHouse-modal').text(data.number_of_days);
    $('#numOfNightsGuestHouse-modal').text(data.number_of_nights);
    $('#arrivalGuestHouse-modal').text(data.arrival);
    $('#departureGuestHouse-modal').text(data.departure);
    $('#numOfMalesGuestHouse-modal').text(data.num_of_male);
    $('#numOfFemalesGuestHouse-modal').text(data.num_of_female);
    $('#rateGuestHouse-modal').text(data.rate);
    if(total_amount == "0.00" && position == 'Student'){
        $('#totalAmountGuestHouse-modal').text('FREE');
    }else{
        $('#totalAmountGuestHouse-modal').text(total_amount);
    }
    $('#beddingGuestHouse-modal').text(data.additional_bedding);
    $('#rentGuestHouse-modal').text(data.videoke_rent);
    $('#specialRequestGuestHouse-modal').text(data.special_request);
    $('#maleGuestHouse-modal').val(data.male_guest);
    $('#femaleGuestHouse-modal').val(data.female_guest);
    $('#view-guesthousebooking-modal').modal('show');
}
function reviewGuestHouseBookingAdminGH(data){
    $('#booking_status_id').val(data.id);
    $('#reviewModal').modal('show');
}
function checkGuestHouseBookingAdminGH(booking) {
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
            url: 'adminGHStatusClientBooking',
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
                        text: "Not found!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "Guest House pre-reservation successfully changed status!",
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
            url: '/adminGHCheckClientBooking',
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
                        text: "Guest House pre-reservation successfully changed status!",
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
