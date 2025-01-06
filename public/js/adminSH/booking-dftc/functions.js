function bookDftc(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/adminSH/view-DFTC-room-pre-reservation-form';
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
    function getCurrentPhilippineTimeSH() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = getCurrentPhilippineTimeSH();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#checkInDateDftc').attr('min', minDateString);
    $('#checkOutDateDftc').prop('disabled', true);

    $('#checkInDateDftc').on('change', function() {
        $('#checkOutDateDftc').val('').prop('disabled', true);

        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#checkOutDateDftc').prop('disabled', false);  // Enable check-out field if check-in date is set
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#checkOutDateDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });

    $('#checkInDateDftc, #checkOutDateDftc, #arrivalDftc, #departureDftc').on('change', computeDaysAndNightsSH);
    $('#checkInDateDftc').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#checkInDateDftc').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#checkOutDateDftc').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function computeDaysAndNightsSH() {
        var checkInDate = new Date($('#checkInDateDftc').val());
        var checkOutDate = new Date($('#checkOutDateDftc').val());
        var arrivalTime = $('#arrivalDftc').val();
        var departureTime = $('#departureDftc').val();

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

        $('#numberOfDaysDftc').val(numberOfDays);
        $('#numberOfNightsDftc').val(numberOfNights);
    }
    $('#checkInDateDftc, #checkOutDateDftc, #arrivalDftc, #departureDftc').on('change', computeDaysAndNightsSH);
    function computeTotalAmountSH() {
        var rate = parseFloat($('#rateDftc').val());
        var capacity = parseInt($('#capacityDftc').val());
        var numOfMale = parseInt($('#numOfMaleDftc').val());
        var numOfFemale = parseInt($('#numOfFemaleDftc').val());
        var bedding = parseInt($('#beddingDftc').val());
        var checkInDate = new Date($('#checkInDateDftc').val());
        var checkOutDate = new Date($('#checkOutDateDftc').val());
        var hasLetterDftc = $('input[name="hasLetterDftc"]:checked').val();
        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#totalAmountDftc').val('0.00');
            return;
        }

        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#totalAmountDftc').val('0.00');
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

        if (hasLetterDftc === "Yes") {
            $('#totalAmountDftc').val('FREE');
            return; // Exit calculation
        }

        totalAmount = rate * totalLodgers * numberOfNights;
        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 200;
        }
        $('#totalAmountDftc').val(totalAmount.toFixed(2));
    }
    $('#rateDftc, #capacityDftc, #numOfMaleDftc, #numOfFemaleDftc, #beddingDftc, #checkInDateDftc, #checkOutDateDftc, #hasLetterDftc').on('change', computeTotalAmountSH);
    $('input[name="hasLetterDftc"]').on('change', computeTotalAmountSH);
    $(document).on('click', '#submitButtonDFTC', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultDFTC')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        const female = parseInt($('#numOfMaleDftc').val(), 10) || 0;
        const male = parseInt($('#numOfFemaleDftc').val(), 10) || 0;

        if(male + female == 0){
            $('#dftcTerms').modal('hide');
            $('#error-messageDftcRoom').html("<strong>Validation Error!</strong> <br><br> Please input number of guest!").show();
            $('#submitButtonDFTC').attr('disabled', false);
            setTimeout(function () {
                $('#error-messageDftcRoom').fadeOut('slow', function () {
                    $(this).hide();
                });
            }, 3000);
        return;
        }
        var numOfMale = parseInt($('#numOfMaleDftc').val());
        var numOfFemale = parseInt($('#numOfFemaleDftc').val());

        if(numOfMale == 0 && numOfFemale == 0){
            $('#dftcTerms').modal('hide');
            $('#error-messageDftcRoom').html("<strong>Validation Error!</strong> <br><br> Please input number of male or female!").show();
                $('#submitButtonDFTC').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageDftcRoom').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
            return;
        }
        const hasLetter = $('input[name="hasLetterDftc"]:checked').val();
        const totalAmount = $('#totalAmountDftc').val();
        const selectedPosition = $('#positionDftc').val();

        if (selectedPosition === 'Student') {
            if (hasLetter === "No" && (totalAmount === '0.00' || isNaN(parseFloat(totalAmount)))) {
                $('#dftcTerms').modal('hide');
                $('#error-messageDftcRoom').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00 if there is no letter approved!!").show();
                $('#submitButtonDFTC').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageDftcRoom').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        } else {
            if (totalAmount === '0.00' || isNaN(parseFloat(totalAmount))) {
                $('#dftcTerms').modal('hide');
                $('#error-messageDftcRoom').html("<strong>Validation Error!</strong> <br><br> Total amount should not be 0.00!").show();
                $('#submitButtonDFTC').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageDftcRoom').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                return;
            }
        }
        let formData = new FormData($('#dftc-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminSHBookingDftc',
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
                    $('#dftcTerms').modal('hide');
                    Swal.close();
                    let errorMessages = '';
                    for (let key in response.message) {
                        if (response.message[key] && Array.isArray(response.message[key])) {
                            errorMessages += response.message[key].join('<br>') + '<br>';
                        }
                    }
                    $('#error-messageDftcRoom').html("<strong>Validation Error!</strong> <br><br>" + errorMessages).show();
                    $('#submitButtonDFTC').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-messageDftcRoom').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
                }else{
                    Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "DFTC pre-reservation is now on pending review.",
                        showConfirmButton: true,
                    }).then(function(){
                        $('#submitButtonDFTC').attr('disabled', false);
                        window.location = "/adminSH/view-my-ongoing-DFTC-pre-reservations";
                    });
                }
            },
            error: function(error){
                console.log(error);

            }
        });
    });
    $('#positionDftc').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#letterInputCellDftc').show();
        } else {
            $('#letterInputCellDftc').hide();
        }
    });
    $('#positionDftc').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("room_numberDftc");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataDftcRoomAdminSH(roomNumber);

        });
    }
});
function fetchRoomDataDftcRoomAdminSH(roomNumber) {
    $.ajax({
        url: '/get-room-dataDftcRoomAdminSH',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#rateDftc').val(data.room_rate);
            $('#capacityDftc').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#rateDftc').val('');
            $('#capacityDftc').val('');
            $('#checkInDateDftc').val('');
            $('#checkOutDateDftc').val('');
            $('#numberOfDaysDftc').val('');
            $('#numOfMaleDftc').val('0');
            $('#numOfFemaleDftc').val('0');
            $('#numberOfNightsDftc').val('');
            $('#totalAmountDftc').val('');
        }
    });
}

