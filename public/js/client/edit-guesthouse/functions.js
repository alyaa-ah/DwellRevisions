function viewGuestHouseBooking(booking){
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
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountGuestHouse-modal').text('FREE');
    }else{
        $('#totalAmountGuestHouse-modal').text(data.total_amount);
    }
    $('#beddingGuestHouse-modal').text(data.additional_bedding);
    $('#rentGuestHouse-modal').text(data.videoke_rent);
    $('#specialRequestGuestHouse-modal').text(data.special_request);
    $('#maleGuestHouse-modal').val(data.male_guest);
    $('#femaleGuestHouse-modal').val(data.female_guest);
    $('#view-guesthousebooking-modal').modal('show');
}
function editGuestHouseBooking(booking){
    var data = JSON.parse(booking);
    $('#editIDGuestHouse').val(data.id);
    $('#editFullNameGuestHouse').val(data.fullname);
    $('#editPositionGuestHouse').val(data.position);
    $('#editEmailGuestHouse').val(data.email);
    $('#editAddressnGuestHouse').val(data.address);
    $('#editAgencyGuestHouse').val(data.agency);
    $('#editContactGuestHouse').val(data.contact);
    $('#editActivityGuestHouse').val(data.activity);
    $('#editFemaleGuestHouse').val(data.female_guest);
    $('#editMaleGuestHouse').val(data.male_guest);
    $('#editSpecialRequestGuestHouse').val(data.special_request);
    var selectedPosition = $('#editPositionGuestHouse').val();
    if (selectedPosition === 'Student') {
        $('#editletterInputCell').show();
    } else {
        $('#editletterInputCell').hide();
    }
    $('#edit-guesthousebooking-modal').modal('show');
}
function cancelGuestHouseBooking(booking){
    var data = JSON.parse(booking);
    $('#GH_bookingID').val(data.id);
    $('#cancel-guesthousebooking-modal').modal('show');
}
$(document).ready(function() {
    function editgetCurrentPhilippineTime() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = editgetCurrentPhilippineTime();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#editCheckInDateGuestHouse').attr('min', minDateString);
    $('#editCheckOutDateGuestHouse').prop('disabled', true);

    $('#editCheckInDateGuestHouse').on('change', function() {
        $('#editCheckOutDateGuestHouse').val('').prop('disabled', true);

        var selectedDate = new Date($(this).val());
        
        if ($(this).val()) {
            $('#editCheckOutDateGuestHouse').prop('disabled', false);  // Enable check-out field if check-in date is set
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#editCheckOutDateGuestHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateGuestHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateGuestHouse, #editCheckOutDateGuestHouse, #editArrivalGuestHouse, #editDepartureGuestHouse').on('change', editcomputeDaysAndNights);
    $('#editCheckInDateGuestHouse').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateGuestHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateGuestHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#editCheckOutDateGuestHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function editcomputeDaysAndNights() {
        var checkInDate = new Date($('#editCheckInDateGuestHouse').val());
        var checkOutDate = new Date($('#editCheckOutDateGuestHouse').val());
        var arrivalTime = $('#editArrivalGuestHouse').val();
        var departureTime = $('#editDepartureGuestHouse').val();

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

        $('#editNumofDaysGuestHouse').val(numberOfDays);
        $('#editNumofNightsGuestHouse').val(numberOfNights);
    }
    $('#editCheckInDateGuestHouse, #editCheckOutDateGuestHouse, #editArrivalGuestHouse, #editDepartureGuestHouse').on('change', editcomputeDaysAndNights);
    function editcomputeTotalAmount() {
        var rate = parseFloat($('#editRateGuestHouse').val());
        var capacity = parseInt($('#editCapacityGuestHouse').val());
        var numOfMale = parseInt($('#editNumOfMaleGuestHouse').val());
        var numOfFemale = parseInt($('#editNumOfFemaleGuestHouse').val());
        var rent = parseInt($('#editRentGuestHouse').val());
        var bedding = parseInt($('#editBeddingGuestHouse').val());
        var checkInDate = new Date($('#editCheckInDateGuestHouse').val());
        var checkOutDate = new Date($('#editCheckOutDateGuestHouse').val());
        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#editTotalAmountGuestHouse').val('0.00');
            return;
        }

        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#editTotalAmountGuestHouse').val('0.00');
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

        if ($('#edithasLetter').val() === "Yes") {
            $('#editTotalAmountGuestHouse').val('FREE');
            return;
        }

        totalAmount = rate * totalLodgers * numberOfNights;

        if (rent === 500) {
            totalAmount += rent;
        }

        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 100;
        }

        $('#editTotalAmountGuestHouse').val(totalAmount.toFixed(2));
    }
    $('#editRateGuestHouse, #editCapacityGuestHouse, #editNumOfMaleGuestHouse, #editNumOfFemaleGuestHouse, #editRentGuestHouse, #editBeddingGuestHouse, #editCheckInDateGuestHouse, #editCheckOutDateGuestHouse, #edithasLetter').on('change', editcomputeTotalAmount);
    function countGuests(guestList) {
        if (!guestList) {
            return 0; 
        }
 
        return guestList.split(',').filter(function(guest) {
            return guest.trim() !== ''; 
        }).length;
    }
    function validateForm() {
  
        let maleCount = countGuests($('#editMaleGuestHouse').val());
        let femaleCount = countGuests($('#editFemaleGuestHouse').val());

  
        let numOfMale = parseInt($('#editNumOfMaleGuestHouse').val(), 10);
        let numOfFemale = parseInt($('#editNumOfFemaleGuestHouse').val(), 10);

     
        if (maleCount !== numOfMale) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "The number of male guests does not match the names entered.",
                showConfirmButton: true,
            });
            return false; 
        }

       
        if (femaleCount !== numOfFemale) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "The number of female guests does not match the names entered.",
                showConfirmButton: true,
            });
            return false;
        }

        return true; 
    }
    $(document).on('click', '#submitButtonEditGuestHouse', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultEditGuestHouse')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        var numOfMale = parseInt($('#editNumOfMaleGuestHouse').val());
        var numOfFemale = parseInt($('#editNumOfFemaleGuestHouse').val());
        if(numOfFemale == 0 && numOfMale == 0) {
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "You must have at least one female guest or male guest!",
                showConfirmButton: true,
            })
            $('#edit-guesthousebooking-modal').modal('show');
            $('#guestHouseTerms').modal('hide');
            return;
        }
        if (!validateForm()) {
            $('#edit-guesthousebooking-modal').modal('show');
            $('#guestHouseTerms').modal('hide');
            return;
        }
        let formData = new FormData($('#edit-guestHouse-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/clientEditGuestHouseBooking',
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
                    $('#edit-guesthousebooking-modal').modal('show');
                    $('#guestHouseTerms').modal('hide');
                    return;
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Guest house pre-reservation successfully modified!",
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
    $(document).on('submit', '#cancel-guesthouse-form', function(event){
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ClientCancelBookingGuestHouse',
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
                    text: "Guest house pre-reservation successfully canceled!",
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
    $('#editPositionGuestHouse').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#editletterInputCell').show();
        } else {
            $('#editletterInputCell').hide();
        }
    });
    $('#editPositionGuestHouse').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("editRoomNumberGuestHouse");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataEditGuestHouse(roomNumber);
        });
    }
});

function fetchRoomDataEditGuestHouse(roomNumber) {
    $.ajax({
        url: '/get-room-data-editClient',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#editRateGuestHouse').val(data.room_rate);
            $('#editCapacityGuestHouse').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#editRateGuestHouse').val('');
            $('#editCapacityGuestHouse').val('');
            $('#editNumofDaysGuestHouse').val('');
            $('#editNumofNightsGuestHouse').val('');
            $('#editCheckInDateGuestHouse').val('');
            $('#editCheckOutDateGuestHouse').val('');
            $('#editNumofDaysGuestHouse').val('');
            $('#editNumOfMaleGuestHouse').val('');
            $('#editNumOfFemaleGuestHouse').val('');
            $('#editArrivalGuestHouse').val('');
            $('#editDepartureGuestHouse').val('');
            $('#editBeddingGuestHouse').val('');
            $('#editTotalAmountGuestHouse').val('');
        }
    });
}

