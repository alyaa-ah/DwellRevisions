function bookStaffHouse(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/adminSH/view-staffhouse-pre-reservation-form';
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
    function getCurrentPhilippineTimeAdminSH() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = getCurrentPhilippineTimeAdminSH();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#checkInDateStaffHouse').attr('min', minDateString);
    $('#checkOutDateStaffHouse').prop('disabled', true);

    $('#checkInDateStaffHouse').on('change', function() {
        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#checkOutDateStaffHouse').prop('disabled', false);
        } else {
            $('#checkOutDateStaffHouse').prop('disabled', true);
        }

        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateStaffHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#checkInDateStaffHouse, #checkOutDateStaffHouse, #arrivalStaffHouse, #departureStaffHouse').on('change', computeDaysAndNightsAdminSH);
    $('#checkInDateStaffHouse').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateStaffHouse').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#checkInDateStaffHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#checkOutDateStaffHouse').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function computeDaysAndNightsAdminSH() {
        var checkInDate = new Date($('#checkInDateStaffHouse').val());
        var checkOutDate = new Date($('#checkOutDateStaffHouse').val());
        var arrivalTime = $('#arrivalStaffHouse').val();
        var departureTime = $('#departureStaffHouse').val();

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
        $('#numberOfDaysStaffHouse').val(numberOfDays);
        $('#numberOfNightsStaffHouse').val(numberOfNights);
    }
    $('#checkInDateStaffHouse, #checkOutDateStaffHouse, #arrivalStaffHouse, #departureStaffHouse').on('change', computeDaysAndNightsAdminSH);
    function computeTotalAmountAdminSH() {
        var rate = parseFloat($('#rateStaffHouse').val());
        var capacity = parseInt($('#capacityStaffHouse').val());
        var numOfMale = parseInt($('#numOfMaleStaffHouse').val());
        var numOfFemale = parseInt($('#numOfFemaleStaffHouse').val());
        var bedding = parseInt($('#beddingStaffHouse').val());
        var checkInDate = new Date($('#checkInDateStaffHouse').val());
        var checkOutDate = new Date($('#checkOutDateStaffHouse').val());

        if (isNaN(rate) || isNaN(capacity) || isNaN(numOfMale) || isNaN(numOfFemale)) {
            $('#totalAmountStaffHouse').val('0.00');
            return;
        }

        var totalLodgers = numOfMale + numOfFemale;

        if (isNaN(totalLodgers)) {
            $('#totalAmountStaffHouse').val('0.00');
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

        if ($('#hasLetterStaffHouse').val() === "Yes") {
            $('#totalAmountStaffHouse').val('FREE');
            return;
        }

        totalAmount = rate * totalLodgers * numberOfNights;


        if (!isNaN(bedding) && bedding > 0) {
            totalAmount += bedding * 200;
        }

        $('#totalAmountStaffHouse').val(totalAmount.toFixed(2));
    }
    $('#rateStaffHouse, #capacityStaffHouse, #numOfMaleStaffHouse, #numOfFemaleStaffHouse, #beddingStaffHouse, #checkInDateStaffHouse, #checkOutDateStaffHouse, #hasLetterStaffHouse').on('change', computeTotalAmountAdminSH);
    $(document).on('click', '#submitButton1', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultStaffHouse')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        var numOfMale = parseInt($('#numOfMaleStaffHouse').val());
        var numOfFemale = parseInt($('#numOfFemaleStaffHouse').val());
        if(numOfFemale === 0 && numOfMale === 0){
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "You must have at least one female guest or male guest!",
                showConfirmButton: true,
            })
            return;
        }
        let formData = new FormData($('#staffHouse-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminSHBookingStaffHouse',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Yikes!",
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
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Staff house pre-reservation successfully added!",
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
    $('#positionStaffHouse').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#letterInputCellStaffHouse').show();
        } else {
            $('#letterInputCellStaffHouse').hide();
        }
    });
    $('#positionStaffHouse').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("room_numberStaffHouse");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataStaffHouseAdminSH(roomNumber);
        });
    }
});
function fetchRoomDataStaffHouseAdminSH(roomNumber) {

    $.ajax({
        url: '/get-room-dataStaffHouseAdminSH',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#baserateStaffHouse').val(data.room_baserate);
            $('#rateStaffHouse').val(data.room_rate);
            $('#capacityStaffHouse').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#rateStaffHouse').val('');
            $('#capacityStaffHouse').val('');
            $('#numOfMaleStaffHouse').val('');
            $('#numOfFemaleStaffHouse').val('');
            $('#beddingStaffHouse').val('');
            $('#checkInDateStaffHouse').val('');
            $('#checkOutDateStaffHouse').val('');
            $('#numberOfDaysStaffHouse').val('');
            $('#numberOfNightsStaffHouse').val('');
            $('#arrivalStaffHouse').val('');
            $('#departureStaffHouse').val('');
            $('#totalAmountStaffHouse').val('');
        }
    });
}

