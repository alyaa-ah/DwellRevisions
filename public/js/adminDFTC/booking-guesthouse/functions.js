
function bookGuestHouse(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/adminDFTC/view-guesthouse-pre-reservation-form';
    form.style.display = 'none';

    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    var dataInput = document.createElement('input');
    dataInput.type = 'hidden';
    dataInput.name = 'data';
    dataInput.value = JSON.stringify(data);
    form.appendChild(dataInput);

    var userInput = document.createElement('input');
    userInput.type = 'hidden';
    userInput.name = 'user';
    userInput.value = JSON.stringify(user);
    form.appendChild(userInput);

    document.body.appendChild(form);
    form.submit();
}
$(document).ready(function() {
    function getCurrentPhilippineTimeAdminDftc() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

        var today = getCurrentPhilippineTimeAdminDftc();
        var minDate = new Date(today.getTime());
        minDate.setDate(today.getDate() + 14);

        var todayString = today.toISOString().split('T')[0];
        var minDateString = minDate.toISOString().split('T')[0];

        $('#checkInDate').attr('min', minDateString);
        $('#checkOutDate').prop('disabled', true);

        $('#checkInDate').on('change', function() {
            $('#checkOutDate').val('').prop('disabled', true);

            var selectedDate = new Date($(this).val());

            if ($(this).val()) {
                $('#checkOutDate').prop('disabled', false);  // Enable check-out field if check-in date is set
                var minCheckOutDate = new Date(selectedDate.getTime());
                $('#checkOutDate').attr('min', minCheckOutDate.toISOString().split('T')[0]);
            }
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#checkOutDate').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        });

        $('#checkInDate, #checkOutDate, #arrival, #departure').on('change', computeDaysAndNightsAdminDftc);
        $('#checkInDate').on('change', function() {
            var selectedDate = new Date($(this).val());
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#checkOutDate').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        });
        $('#checkInDate').on('keydown', function(event) {
            var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
            if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
                event.preventDefault();
            }
        });
        $('#checkOutDate').on('keydown', function(event) {
            var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
            if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
                event.preventDefault();
            }
        });
    function computeDaysAndNightsAdminDftc() {
        var checkInDate = new Date($('#checkInDate').val());
        var checkOutDate = new Date($('#checkOutDate').val());
        var arrivalTime = $('#arrival').val();
        var departureTime = $('#departure').val();

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

        $('#numberOfDays').val(numberOfDays);
        $('#numberOfNights').val(numberOfNights);
    }
    $('#checkInDate, #checkOutDate, #arrival, #departure').on('change', computeDaysAndNightsAdminDftc);
    function computeTotalAmountAdminDftc() {
        var rate = parseFloat($('#rate').val());
        var capacity = parseInt($('#capacity').val());
        var numOfMale = parseInt($('#numOfMale').val());
        var numOfFemale = parseInt($('#numOfFemale').val());
        var rent = parseInt($('#rent').val());
        var bedding = parseInt($('#bedding').val());
        var checkInDate = new Date($('#checkInDate').val());
        var checkOutDate = new Date($('#checkOutDate').val());
        var hasLetter = $('input[name="hasLetter"]:checked').val();
        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#totalAmount').val('0.00');
            return;
        }

        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#totalAmount').val('0.00');
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
            $('#totalAmount').val('FREE');
            return;
        }


        totalAmount = rate * totalLodgers * numberOfNights;

        if (rent === 500) {
            totalAmount += rent;
        }

        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 100;
        }
        $('#totalAmount').val(totalAmount.toFixed(2));
    }
    $('#rate, #capacity, #numOfMale, #numOfFemale, #rent, #bedding, #checkInDate, #checkOutDate, #hasLetter').on('change', computeTotalAmountAdminDftc);
    $('input[name="hasLetter"]').on('change', computeTotalAmountAdminDftc);
    $(document).on('click', '#submitButton', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefault')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        const female = parseInt($('#numOfFemale').val(), 10) || 0;
        const male = parseInt($('#numOfMale').val(), 10) || 0;

        if(male + female == 0){
            $('#guestHouseTerms').modal('hide');
            $('#error-message').html("<strong>Validation Error!</strong> <br><br> Please input number of guest!").show();
            $('#submitButton').attr('disabled', false);
            setTimeout(function () {
                $('#error-message').fadeOut('slow', function () {
                    $(this).hide();
                });
            }, 3000);
        return;
        }
        const maleGuestsInputs = $('input[name="maleGuests[]"]');
        const femaleGuestsInputs = $('input[name="femaleGuests[]"]');

        for (let input of maleGuestsInputs) {
            if (!input.value.trim()) {
                $('#guestHouseTerms').modal('hide');
                $('#error-message').html("<strong>Validation Error!</strong> <br><br> Please input male guest!").show();
                $('#submitButton').attr('disabled', false);
                setTimeout(function () {
                    $('#error-message').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }

        for (let input of femaleGuestsInputs) {
            if (!input.value.trim()) {
                $('#guestHouseTerms').modal('hide');
                $('#error-message').html("<strong>Validation Error!</strong> <br><br> Please input female guest!").show();
                    $('#submitButton').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-message').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
                return;
            }
        }
        const hasLetter = $('input[name="hasLetter"]:checked').val();
        const totalAmount = $('#totalAmount').val();
        const selectedPosition = $('#position').val();

        if (selectedPosition === 'Student') {
            if (hasLetter === "No" && (totalAmount === '0.00' || isNaN(parseFloat(totalAmount)))) {
                $('#guestHouseTerms').modal('hide');
                $('#error-message').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00 if there is no letter approved!!").show();
                $('#submitButton').attr('disabled', false);
                setTimeout(function () {
                    $('#error-message').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        } else {
            if (totalAmount === '0.00' || isNaN(parseFloat(totalAmount))) {
                $('#guestHouseTerms').modal('hide');
                $('#error-message').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00!").show();
                $('#submitButton').attr('disabled', false);
                setTimeout(function () {
                    $('#error-message').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }
        let formData = new FormData($('#guestHouse-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminDftcBookingGuestHouse',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Loading...',
                    text: 'Please wait while we process your pre-reservation.',
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
                        text: "Could not pre-reserve at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                    $('#guestHouseTerms').modal('hide');
                    Swal.close();
                    let errorMessages = '';
                    for (let key in response.message) {
                        if (response.message[key] && Array.isArray(response.message[key])) {
                            errorMessages += response.message[key].join('<br>') + '<br>';
                        }
                    }
                    $('#error-message').html("<strong>Validation Error!</strong> <br><br>" + errorMessages).show();
                    $('#submitButton').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-message').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Guest house pre-reservation is now on pending review.",
                    showConfirmButton: true,
                }).then(function(){
                    $('#submitButton').attr('disabled', false);
                    window.location = "/adminDFTC/view-my-ongoing-guesthouse-pre-reservations";
                });
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
    $('#position').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#letterInputCell').show();
        } else {
            $('#letterInputCell').hide();
        }
    });
    $('#position').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("room_number");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataAdminDftc(roomNumber);
        });
    }
});
function fetchRoomDataAdminDftc(roomNumber) {
    $.ajax({
        url: '/get-room-dataGuestHouseAdminDftc',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#rate').val(data.room_rate);
            $('#capacity').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#rate').val('');
            $('#capacity').val('');
            $('#numberOfDays').val('');
            $('#numberOfNights').val('');
            $('#checkInDate').val('');
            $('#checkOutDate').val('');
            $('#numOfMale').val('0');
            $('#numOfFemale').val('0');
            $('#totalAmount').val('');
        }
    });
}

