function bookDftc(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/superAdmin/view-dftc-room-form';
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
    function computeTotalAmount() {
        var rate = parseFloat($('#rateDftc').val());
        var capacity = parseInt($('#capacityDftc').val());
        var numOfMale = parseInt($('#numOfMaleDftc').val());
        var numOfFemale = parseInt($('#numOfFemaleDftc').val());
        var bedding = parseInt($('#beddingDftc').val());
        var checkInDate = new Date($('#checkInDateDftc').val());
        var checkOutDate = new Date($('#checkOutDateDftc').val());

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

        if ($('#hasLetterDftc').val() === "Yes") {
            $('#totalAmountDftc').val('FREE');
            return;
        }
        totalAmount = rate * totalLodgers * numberOfNights;
        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 200;
        }
        $('#totalAmountDftc').val(totalAmount.toFixed(2));
    }
    $('#rateDftc, #capacityDftc, #numOfMaleDftc, #numOfFemaleDftc, #beddingDftc, #checkInDateDftc, #checkOutDateDftc, #hasLetterDftc').on('change', computeTotalAmount);
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

    $('#checkInDateDftc').attr('min', minDateString);
    $('#checkOutDateDftc').prop('disabled', true);

    $('#checkInDateDftc').on('change', function() {
        var selectedDate = new Date($(this).val());
        if ($(this).val()) {
            $('#checkOutDateDftc').prop('disabled', false);
        } else {
            $('#checkOutDateDftc').prop('disabled', true);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });

    $('#checkInDateDftc, #checkOutDateDftc, #arrivalDftc, #departureDftc').on('change', computeDaysAndNights);
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
    function computeDaysAndNights() {
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
    $('#checkInDateDftc, #checkOutDateDftc, #arrivalDftc, #departureDftc').on('change', computeDaysAndNights);
    $(document).on('click', '#submitButtonDftc', function(event){
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
        var numOfMale = parseInt($('#numOfMaleDftc').val());
        var numOfFemale = parseInt($('#numOfFemaleDftc').val());

        if(numOfMale == 0 && numOfFemale == 0){
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "You must have at least one female guest or male guest!",
                showConfirmButton: true,
            })
            $('#dftcTerms').modal('hide');
            return;
        }
        let formData = new FormData($('#dftc-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/booking-dftc',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#submitButtonDftc').attr('disabled', true);
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
                        $('#submitButtonDFTC').attr('disabled', false);
                        $('#dftcTerms').modal('hide');
                    });
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "DFTC pre-reservation successfully added!",
                    showConfirmButton: true,
                }).then(function(){
                    $('#submitButtonDFTC').attr('disabled', false);
                    window.location.reload();
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
            fetchRoomDataDftcRoom(roomNumber);
        });
    }
});
function fetchRoomDataDftcRoom(roomNumber) {
    $.ajax({
        url: '/superAdmin/DFTC/get-room-data',
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
            $('#arrivalDftc').val('');
            $('#departureDftc').val('');
            $('#numberOfDaysDftc').val('');
            $('#numOfMaleDftc').val('');
            $('#numOfFemaleDftc').val('');
            $('#numberOfNightsDftc').val('');
            $('#totalAmountDftc').val('');
        }
    });
}

