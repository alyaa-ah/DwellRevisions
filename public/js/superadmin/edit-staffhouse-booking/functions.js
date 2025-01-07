function viewStaffHouseBooking(booking){
    var data = JSON.parse(booking);
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
function editStaffHouseBooking(booking){
    var data = JSON.parse(booking);
    $('#editIDStaffHouse').val(data.id);
    $('#editFullNameStaffHouse').val(data.fullname);
    $('#editPositionStaffHouse').val(data.position);
    $('#editEmailStaffHouse').val(data.email);
    $('#editAddressStaffHouse').val(data.address);
    $('#editAgencyStaffHouse').val(data.agency);
    $('#editContactStaffHouse').val(data.contact);
    $('#editActivityStaffHouse').val(data.activity);
    $('#editFemaleGuestsStaffHouse').val(data.female_guest);
    $('#editMaleGuestsStaffHouse').val(data.male_guest);
    $('#editSpecialRequestsStaffHouse').val(data.special_request);

    $('#edit-payment').val(data.payment);
    $('#edit-staffhousebooking-modal').modal('show');
    var selectedPosition = $('#editPositionStaffHouse').val();
    if (selectedPosition === 'Student') {
        $('#editLetterInputCellStaffHouse').show();
    } else {
        $('#editLetterInputCellStaffHouse').hide();
    }
    if (selectedPosition === 'Guest' || selectedPosition === 'Student') {
        $('#edit-payment').val('Cash');
        $('#edit-payment').prop('disabled', true);
    } else {
        $('#edit-payment').prop('disabled', false);
        $('#payment-hidden').val($('#edit-payment').val());
    }
}
function cancelStaffHouseBooking(booking){
    var data = JSON.parse(booking);
    $('#SH_bookingID').val(data.id);
    $('#cancel-staffhousebooking-modal').modal('show');
}
$(document).ready(function() {
    function editGetCurrentPhilippineTime() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = editGetCurrentPhilippineTime();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#editCheckInDateStaffHouse').attr('min', minDateString);
    $('#editCheckOutDateStaffHouse').prop('disabled', true);

    $('#editCheckInDateStaffHouse').on('change', function() {
        $('#editCheckOutDateStaffHouse').val('').prop('disabled', true);

        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#editCheckOutDateStaffHouse').prop('disabled', false);  // Enable check-out field if check-in date is set
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#editCheckOutDateStaffHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateStaffHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });

    $('#editCheckInDateStaffHouse, #editCheckOutDateStaffHouse, #editArrivalStaffHouse, #editDepartureStaffHouse').on('change', editComputeDaysAndNights);
    $('#editCheckInDateStaffHouse').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateStaffHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateStaffHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#editCheckOutDateStaffHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function editComputeDaysAndNights() {
        var checkInDate = new Date($('#editCheckInDateStaffHouse').val());
        var checkOutDate = new Date($('#editCheckOutDateStaffHouse').val());
        var arrivalTime = $('#editArrivalStaffHouse').val();
        var departureTime = $('#editDepartureStaffHouse').val();

        var arrivalHours = parseInt(arrivalTime.split(':')[0]);
        var arrivalMinutes = parseInt(arrivalTime.split(':')[1]);
        var departureHours = parseInt(departureTime.split(':')[0]);
        var departureMinutes = parseInt(departureTime.split(':')[1]);

        checkInDate.setHours(arrivalHours, arrivalMinutes);
        checkOutDate.setHours(departureHours, departureMinutes);

        var timeDifference = checkOutDate - checkInDate;
        var numberOfDays = Math.floor(timeDifference / (1000 * 3600 * 24));
        var numberOfNights = Math.ceil(timeDifference / (1000 * 3600 * 24));

        if (isNaN(numberOfDays) || numberOfDays < 0 || isNaN(numberOfNights) || numberOfNights < 0) {
            numberOfDays = 0;
            numberOfNights = 0;
        }

        $('#editNumofDaysStaffHouse').val(numberOfDays);
        $('#editNumofNightsStaffHouse').val(numberOfNights);
    }
    $('#editCheckInDateStaffHouse, #editCheckOutDateStaffHouse, #editArrivalStaffHouse, #editDepartureStaffHouse').on('change', editComputeDaysAndNights);
    function editComputeTotalAmount() {
        var rate = parseFloat($('#editRateStaffHouse').val());
        var capacity = parseInt($('#editCapacityStaffHouse').val());
        var numOfMale = parseInt($('#editNumOfMaleStaffHouse').val());
        var numOfFemale = parseInt($('#editNumOfFemaleStaffHouse').val());
        var bedding = parseInt($('#editBeddingStaffHouse').val());
        var checkInDate = new Date($('#editCheckInDateStaffHouse').val());
        var checkOutDate = new Date($('#editCheckOutDateStaffHouse').val());
        var hasLetter = $('input[name="hasLetterStaffHouseEdit"]:checked').val();
        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#editTotalAmountStaffHouse').val('0.00');
            return;
        }
        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#editTotalAmountStaffHouse').val('0.00');
            return;
        }
        var oneDay = 24 * 60 * 60 * 1000;
        var checkInTime = checkInDate.getTime();
        var checkOutTime = checkOutDate.getTime();
        var numberOfNights = Math.round(Math.abs((checkOutTime - checkInTime) / oneDay));

        if (numberOfNights === 0) {
            numberOfNights = 1;
        }

        var totalAmount = 0;

        if (hasLetter=== "Yes") {
            $('#editTotalAmountStaffHouse').val('FREE');
            return;
        }

        totalAmount = rate * totalLodgers * numberOfNights;


        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 200;
        }
        $('#editTotalAmountStaffHouse').val(totalAmount.toFixed(2));
    }
    $('#editRateStaffHouse, #editCapacityStaffHouse, #editNumOfMaleStaffHouse, #editNumOfFemaleStaffHouse, #editBeddingStaffHouse, #editCheckInDateStaffHouse, #editCheckOutDateStaffHouse, #editHasLetterStaffHouse').on('change', editComputeTotalAmount);
    $('input[name="hasLetterStaffHouseEdit"]').on('change', editComputeTotalAmount);
    $(document).on('click', '#submitButtonEditStaffHouse', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultEditStaffHouse')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please read and check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        const female = parseInt($('#editNumOfFemaleStaffHouse').val(), 10) || 0;
        const male = parseInt($('#editNumOfMaleStaffHouse').val(), 10) || 0;

        if(male + female == 0){
            $('#editStaffHouseTerms').modal('hide');
            $('#edit-staffhousebooking-modal').modal('show')
            $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br> Please input number of guest!").show();
            $('#submitButtonEditStaffHouse').attr('disabled', false);
            setTimeout(function () {
                $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                    $(this).hide();
                });
            }, 3000);
        return;
        }
        const maleGuestsInputs = $('input[name="maleGuests[]"]');
        const femaleGuestsInputs = $('input[name="femaleGuests[]"]');
        for (let input of maleGuestsInputs) {
            if (!input.value.trim()) {
                $('#editStaffHouseTerms').modal('hide');
                $('#edit-staffhousebooking-modal').modal('show');
                Swal.close();

                $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br> Input male guests!").show();
                $('#submitButtonStaffHouse').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }
        for (let input of femaleGuestsInputs) {
            if (!input.value.trim()) {
                $('#editStaffHouseTerms').modal('hide');
                $('#edit-staffhousebooking-modal').modal('show');
                Swal.close();

                $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br> Input female guests!").show();
                $('#submitButtonStaffHouse').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }
        const hasLetter = $('input[name="hasLetterStaffHouseEdit"]:checked').val();
        const totalAmount = $('#editTotalAmountStaffHouse').val();
        const selectedPosition = $('#editPositionStaffHouse').val();

        if (selectedPosition === 'Student') {
            if (hasLetter === "No" && (totalAmount === '0.00' || isNaN(parseFloat(totalAmount)))) {
                $('#editStaffHouseTerms').modal('hide');
                $('#edit-staffhousebooking-modal').modal('show');
                $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00 if there is no letter approved!!").show();
                $('#submitButtonEditStaffHouse').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        } else {
            if (totalAmount === '0.00' || isNaN(parseFloat(totalAmount))) {
                $('#editStaffHouseTerms').modal('hide');
                $('#edit-staffhousebooking-modal').modal('show');
                $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00!").show();
                $('#submitButtonEditStaffHouse').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }
        let formData = new FormData($('#edit-staffHouse-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/updateStaffHouseBooking',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not pre-reserve at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                    $('#editStaffHouseTerms').modal('hide');
                    $('#edit-staffhousebooking-modal').modal('show');
                    Swal.close();
                    let errorMessages = '';
                    for (let key in response.message) {
                        if (response.message[key] && Array.isArray(response.message[key])) {
                            errorMessages += response.message[key].join('<br>') + '<br>';
                        }
                    }
                    $('#error-messageEditStaffHouse').html("<strong>Validation Error!</strong> <br><br>" + errorMessages).show();
                    $('#submitButtonStaffHouse').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-messageEditStaffHouse').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
                    return;
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Staff house pre-reservation successfully modified!",
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
    $(document).on('submit', '#cancel-staffhouse-form', function(event){
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/cancelStaffHouseBooking',
            method: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we process your cancellation.',
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
                        text: "Could not cancel at this time!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Staff house pre-reservation successfully canceled!",
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
    $('#editPositionStaffHouse').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#editLetterInputCellStaffHouse').show();
        } else {
            $('#editLetterInputCellStaffHouse').hide();
        }
    });
    $('#editPositionStaffHouse').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("editRoomNumberStaffHouse");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataEditStaffHouse(roomNumber);
        });
    }
});
function fetchRoomDataEditStaffHouse(roomNumber) {
    $.ajax({
        url: '/superAdmin/editStaffHouse-get-room-data',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#editRateStaffHouse').val(data.room_rate);
            $('#editCapacityStaffHouse').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#editRateStaffHouse').val('');
            $('#editCapacityStaffHouse').val('');
            $('#editNumofDaysStaffHouse').val('');
            $('#editNumofNightsStaffHouse').val('');
            $('#editCheckInDateStaffHouse').val('');
            $('#editCheckOutDateStaffHouse').val('');
            $('#editNumofDaysStaffHouse').val('');
            $('#editNumOfMaleStaffHouse').val('0');
            $('#editNumOfFemaleStaffHouse').val('0');
            $('#editBeddingStaffHouse').val('');
            $('#editTotalAmountStaffHouse').val('');
        }
    });
}
