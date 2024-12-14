
function bookGuestHouse(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/superAdmin/view-guesthouse-form';
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
    function getCurrentPhilippineTime() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }
        var today = getCurrentPhilippineTime();
        var minDate = new Date(today.getTime());
        minDate.setDate(today.getDate() + 14);

        var todayString = today.toISOString().split('T')[0];
        var minDateString = minDate.toISOString().split('T')[0];

        $('#checkInDate').attr('min', minDateString);
        $('#checkOutDate').prop('disabled', true);
        $('#checkInDate').on('change', function() {
            var selectedDate = new Date($(this).val());

            if ($(this).val()) {
                $('#checkOutDate').prop('disabled', false);
            } else {
                $('#checkOutDate').prop('disabled', true);
            }

            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#checkOutDate').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        });

        $('#checkInDate, #checkOutDate, #arrival, #departure').on('change', computeDaysAndNights);
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
    function computeDaysAndNights() {
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

    $('#checkInDate, #checkOutDate, #arrival, #departure').on('change', computeDaysAndNights);
    function computeTotalAmount() {
        var rate = parseFloat($('#rate').val());
        var capacity = parseInt($('#capacity').val());
        var numOfMale = parseInt($('#numOfMale').val());
        var numOfFemale = parseInt($('#numOfFemale').val());
        var rent = parseInt($('#rent').val());
        var bedding = parseInt($('#bedding').val());
        var checkInDate = new Date($('#checkInDate').val());
        var checkOutDate = new Date($('#checkOutDate').val());

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

        if ($('#hasLetter').val() === "Yes") {
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
    $('#rate, #capacity, #numOfMale, #numOfFemale, #rent, #bedding, #checkInDate, #checkOutDate, #hasLetter').on('change', computeTotalAmount);
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
        var numOfMale = parseInt($('#numOfMale').val());
        var numOfFemale = parseInt($('#numOfFemale').val());
        if(numOfFemale === 0 && numOfMale === 0){
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "You must have at least one female guest or male guest!",
                showConfirmButton: true,
            })
            $('#guestHouseTerms').modal('hide');
            return;
        }
        let formData = new FormData($('#guestHouse-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/guestHouse-booking',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#submitButton').attr('disabled', true);
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
                    var errorMessages = Object.values(response.message).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Pre-reservation validation failed!',
                        html: errorMessages,
                        showConfirmButton: true,
                    }).then(function() {
                        $('#submitButton').attr('disabled', false);
                        $('#guestHouseTerms').modal('hide');
                    });
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Guest house pre-reservation successfully added!",
                    showConfirmButton: true,
                }).then(function(){
                    $('#submitButton').attr('disabled', false);
                    window.location.reload();
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
            fetchRoomDataGuestHouse(roomNumber);
        });
    }
});
function fetchRoomDataGuestHouse(roomNumber) {
    $.ajax({
        url: '/superAdmin/guestHouses-get-room-data',
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
            $('#numOfMale').val('');
            $('#numOfFemale').val('');
            $('#arrival').val('');
            $('#departure').val('');
            $('#totalAmount').val('');
        }
    });
}

