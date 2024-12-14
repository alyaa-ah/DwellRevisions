function viewAdminDftcDftcRoomBooking(booking){
    var data = JSON.parse(booking);
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameDftcRoom-modal').text(data.fullname);
    $('#emailDftcRoom-modal').text(data.email);
    $('#contactDftcRoom-modal').text(data.contact);
    $('#homeAddressDftcRoom-modal').text(data.address);
    $('#positionDftcRoom-modal').text(data.position);
    $('#agencyDftcRoom-modal').text(data.agency);
    $('#datetimeFilledUpDftcRoom-modal').text(data.DFTC_date);
    $('#bookingNumberDftcRoom-modal').text(data.DFTC_number);
    $('#activityDftcRoom-modal').text(data.activity);
    $('#roomNumberDftcRoom-modal').text(data.room_number);
    $('#checkInDateDftcRoom-modal').text(data.check_in_date);
    $('#checkOutDateDftcRoom-modal').text(data.check_out_date);
    $('#numOfDaysDftcRoom-modal').text(data.number_of_days);
    $('#numOfNightsDftcRoom-modal').text(data.number_of_nights);
    $('#arrivalDftcRoom-modal').text(data.arrival);
    $('#departureDftcRoom-modal').text(data.departure);
    $('#numOfMalesDftcRoom-modal').text(data.num_of_male);
    $('#numOfFemalesDftcRoom-modal').text(data.num_of_female);
    $('#rateDftcRoom-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountDftcRoom-modal').text('FREE');
    }else{
        $('#totalAmountDftcRoom-modal').text(data.total_amount);
    }
    $('#specialRequestDftcRoom-modal').text(data.special_request);
    $('#view-DftcRoom-modal').modal('show');
}
function editAdminDftcDftcRoomBooking(booking){
    var data = JSON.parse(booking);
    $('#editIdDftcRoom').val(data.id);
    $('#editFullNameDftcRoom').val(data.fullname);
    $('#editPositionDftcRoom').val(data.position);
    $('#editEmailDftcRoom').val(data.email);
    $('#editAddressDftcRoom').val(data.address);
    $('#editAgencyDftcRoom').val(data.agency);
    $('#editContactDftcRoom').val(data.contact);
    $('#editActivityDftcRoom').val(data.activity);
    $('#editSpecialRequestDftcRoom').val(data.special_request);
    var selectedPosition = $('#editPositionDftcRoom').val();
    if (selectedPosition === 'Student') {
        $('#editLetterInputCellDftcRoom').show();
    } else {
        $('#editLetterInputCellDftcRoom').hide();
    }
    $('#edit-dftcroombooking-modal').modal('show');
}
function cancelAdminDftcDftcBooking(booking){
    var data = JSON.parse(booking);
    $('#DFTC_bookingID').val(data.id);
    $('#cancel-dftcbooking-modal').modal('show');
}
$(document).ready(function() {
    function getCurrentPhilippineTimeEditDfctRoomAdminDftc() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = getCurrentPhilippineTimeEditDfctRoomAdminDftc();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#editCheckInDateDftcRoom').attr('min', minDateString);
    $('#editCheckOutDateDftcRoom').prop('disabled', true);

    $('#editCheckInDateDftcRoom').on('change', function() {
        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#editCheckOutDateDftcRoom').prop('disabled', false);
        } else {
            $('#editCheckOutDateDftcRoom').prop('disabled', true);
        }

        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateDftcRoom').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });

    $('#editCheckInDateDftcRoom, #editCheckOutDateDftcRoom, #editArrivalDftcRoom, #editDepartureDftcRoom').on('change', computeDaysAndNightsEditDfctRoomAdminDftc);
    $('#editCheckInDateDftcRoom').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateDftcRoom').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateDftcRoom').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#editCheckOutDateDftcRoom').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function computeDaysAndNightsEditDfctRoomAdminDftc() {
        var checkInDate = new Date($('#editCheckInDateDftcRoom').val());
        var checkOutDate = new Date($('#editCheckOutDateDftcRoom').val());
        var arrivalTime = $('#editArrivalDftcRoom').val();
        var departureTime = $('#editDepartureDftcRoom').val();

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
        $('#editNumOfDaysDftcRoom').val(numberOfDays);
        $('#editNumOffNightsDftcRoom').val(numberOfNights);
    }
    $('#editCheckInDateDftcRoom, #editCheckOutDateDftcRoom, #editArrivalDftcRoom, #editDepartureDftcRoom').on('change', computeDaysAndNightsEditDfctRoomAdminDftc);
    function computeTotalAmountEditDftcRoomAdminDftc() {
        var rate = parseFloat($('#editRateDftcRoom').val());
        var capacity = parseInt($('#editCapacityDftcRoom').val());
        var numOfMale = parseInt($('#editNumOfMaleDftcRoom').val());
        var numOfFemale = parseInt($('#editNumOfFemaleDftcRoom').val());
        var checkInDate = new Date($('#editCheckInDateDftcRoom').val());
        var checkOutDate = new Date($('#editCheckOutDateDftcRoom').val());

        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#editTotalAmountDftcRoom').val('0.00');
            return;
        }

        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#editTotalAmountDftcRoom').val('0.00');
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

        if ($('#editHasLetterDftcRoom').val() === "Yes") {
            $('#editTotalAmountDftcRoom').val('FREE');
            return;
        }
        totalAmount = rate * totalLodgers * numberOfNights;
        $('#editTotalAmountDftcRoom').val(totalAmount.toFixed(2));
    }
    $('#editRateDftcRoom, #editCapacityDftcRoom, #editNumOfMaleDftcRoom, #editNumOfFemaleDftcRoom, #editCheckInDateDftcRoom, #editCheckOutDateDftcRoom, #editHasLetterDftcRoom').on('change', computeTotalAmountEditDftcRoomAdminDftc);
    $(document).on('click', '#submitButtonEditDftcRoom', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultEditDftcRoom')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please read and check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        var numOfMale = parseInt($('#editNumOfMaleDftcRoom').val());
        var numOfFemale = parseInt($('#editNumOfFemaleDftcRoom').val());
        if (numOfMale == 0 && numOfFemale == 0) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "You must have at least one female guest or male guest!",
                showConfirmButton: true,
            })
            $('#edit-dftcroombooking-modal').modal('show');
            $('#dftcTermsEditDftcRoom').modal('hide');
            return;
        }
        let formData = new FormData($('#edit-dftcroom-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminDftcEditBookingDftcRoom',
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
                    var errorMessages = Object.values(response.message).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Pre-reservation validation failed!',
                        html: errorMessages,
                        showConfirmButton: true,
                    });
                    $('#edit-dftcroombooking-modal').modal('show');
                    $('#dftcTermsEditDftcRoom').modal('hide');
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All Set!",
                    text: "DFTC pre-reservation successfully modified!",
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
    $(document).on('submit', '#cancel-dftc-form', function(event){
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminDftcCancelBookingDftc',
            method: 'POST',
            data: $(this).serialize(),
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
                    text: "DFTC pre-reservation successfully canceled!",
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
    $('#editPositionDftcRoom').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#editletterInputCellDftcRoom').show();
        } else {
            $('#editletterInputCellDftcRoom').hide();
        }
    });
    $('#editPositionDftcRoom').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("editRoomNumberDftcRoom");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataEditDftcRoomAdminDftc(roomNumber);

        });
    }
});
function fetchRoomDataEditDftcRoomAdminDftc(roomNumber) {
    $.ajax({
        url: '/get-room-dataEditDftcRoomAdminDftc',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#editRateDftcRoom').val(data.room_rate);
            $('#editCapacityDftcRoom').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#editRateDftcRoom').val('');
            $('#editCapacityDftcRoom').val('');
            $('#editCheckInDateDftcRoom').val('');
            $('#editCheckOutDateDftcRoom').val('');
            $('#editArrivalDftcRoom').val('');
            $('#editDepartureDftcRoom').val('');
            $('#editNumOfDaysDftcRoom').val('');
            $('#editNumOfMaleDftcRoom').val('');
            $('#editNumOfFemaleDftcRoom').val('');
            $('#editNumOffNightsDftcRoom').val('');
            $('#editTotalAmountDftcRoom').val('');
        }
    });
}
