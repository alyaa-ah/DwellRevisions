function bookDftcHall(room, user) {
    var data = JSON.parse(room);
    var user = JSON.parse(user);

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/adminGH/view-DFTC-hall-pre-reservation-form';
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
    function getCurrentPhilippineTimeDftcHallAdminGH() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = getCurrentPhilippineTimeDftcHallAdminGH();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#checkInDateHallDftc').attr('min', minDateString);
    $('#checkOutDateHallDftc').prop('disabled', true);

    $('#checkInDateHallDftc').on('change', function() {
        $('#checkOutDateHallDftc').val('').prop('disabled', true);

        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#checkOutDateHallDftc').prop('disabled', false);  // Enable check-out field if check-in date is set
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#checkOutDateHallDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateHallDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });

    $('#checkInDateHallDftc, #checkOutDateHallDftc, #arrivalHallDftc, #departureHallDftc').on('change', computeDaysAndNightsDftcAdminGH);
    $('#checkInDateHallDftc').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#checkOutDateHallDftc').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#checkInDateHallDftc').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#checkOutDateHallDftc').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function computeDaysAndNightsDftcAdminGH() {
        var checkInDate = new Date($('#checkInDateHallDftc').val());
        var checkOutDate = new Date($('#checkOutDateHallDftc').val());
        var arrivalTime = $('#arrivalHallDftc').val();
        var departureTime = $('#departureHallDftc').val();

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

        $('#numberOfDaysHallDftc').val(numberOfDays);
        $('#numberOfNightsHallDftc').val(numberOfNights);
    }
    $('#checkInDateHallDftc, #checkOutDateHallDftc, #arrivalHallDftc, #departureHallDftc').on('change', computeDaysAndNightsDftcAdminGH);
    function isHolidayOrWeekendAdminGH(date) {
        var holidays = [
            '2024-01-01', '2024-03-28', '2024-03-29', '2024-04-09', '2024-05-01',
            '2024-06-12', '2024-06-17', '2024-08-26', '2024-11-30', '2024-12-25'
        ];
        var dayOfWeek = date.getDay();
        var dateString = date.toISOString().split('T')[0];
        return holidays.includes(dateString) || dayOfWeek === 0 || dayOfWeek === 6;
    }

    function computeTotalAmountDftcHallAdminGH() {
        var baseRate = parseFloat($('#rateHallDftc').val());
        var capacity = parseInt($('#capacityHallDftc').val());
        var checkInDate = new Date($('#checkInDateHallDftc').val());
        var checkOutDate = new Date($('#checkOutDateHallDftc').val());
        var arrival = $('#arrivalHallDftc').val();
        var departure = $('#departureHallDftc').val();
        var timerate = 0;
        var timeRateNonHoliday = 0;
        var jservices = 0;
        var avservices = 0;
        var timeLimit = 0;
        var timeLimitHoliday = 0;
        var oneDay = 24 * 60 * 60 * 1000;
        var numberOfHolidays = 0;
        var numberOfNonHolidays = 0;
        var arrivalHours = parseInt(arrival.split(':')[0]);
        var arrivalMinutes = parseInt(arrival.split(':')[1]);
        var departureHours = parseInt(departure.split(':')[0]);
        var departureMinutes = parseInt(departure.split(':')[1]);
        var totalRate = 0;
        var checkInTime = checkInDate.getTime();
        var checkOutTime = checkOutDate.getTime();
        var numberOfDays = Math.ceil((checkOutTime - checkInTime) / oneDay);
        var hasLetterDftcHall = $('input[name="hasLetterHallDftc"]:checked').val();
        if (numberOfDays === 0) {
            numberOfDays = 1;
        } else {
            numberOfDays++;
        }
        var holidayJServices = 0;
        var holidayAvServices = 0;
        var baseHolidayRate = 1400;
        var timeRateHoliday = 0;
        for (var i = 0; i < numberOfDays; i++) {
            var dailyRate = baseRate;
            var currentDay = new Date(checkInDate);
            currentDay.setDate(currentDay.getDate() + i);
            if (i === 0 && arrivalHours >= 16) {
                timerate = (capacity == 200) ? 500 : 1000;
                dailyRate += timerate;
            }

            var dailyCheckInDateTime = new Date(currentDay);
            dailyCheckInDateTime.setHours(arrivalHours, arrivalMinutes);

            var dailyCheckOutDateTime = new Date(currentDay);
            dailyCheckOutDateTime.setHours(departureHours, departureMinutes);

            if (dailyCheckOutDateTime < dailyCheckInDateTime) {
                dailyCheckOutDateTime.setDate(dailyCheckOutDateTime.getDate() + 1);
            }

            var dailyStayDuration = dailyCheckOutDateTime - dailyCheckInDateTime;

            if (isHolidayOrWeekendAdminGH(currentDay)) {
                numberOfHolidays++;
                holidayJServices = 700;
                holidayAvServices = 700;
                if (arrivalHours >= 17) {
                    timeRateHoliday = 0;
                    timeRateHoliday = (capacity == 200) ? 500 : 1000;
                    if (dailyStayDuration >= 1 * 60 * 60 * 1000) {
                        holidayAvServices = 700;
                        holidayJServices =  700;
                        var hoursInRangeHoliday = Math.ceil((dailyStayDuration - 0 * 60 * 60 * 1000) / (60 * 60 * 1000));
                        holidayJServices += 100 * hoursInRangeHoliday;
                        holidayAvServices += 100 * hoursInRangeHoliday;
                    }
                } else {
                    if (dailyStayDuration > 10 * 60 * 60 * 1000) {
                        var extraHoursHoliday = Math.ceil((dailyStayDuration - 10 * 60 * 60 * 1000) / (60 * 60 * 1000));
                        holidayAvServices = 700;
                        holidayJServices = 700;
                        holidayJServices += 100 * extraHoursHoliday;
                        holidayAvServices += 100 * extraHoursHoliday;
                        timeLimitHoliday += 500 * extraHoursHoliday;
                    }
                }
            } else {
                numberOfNonHolidays++;
                if (arrivalHours >= 17) {
                    timeRateNonHoliday = 0;
                    timeRateNonHoliday = (capacity == 200) ? 500 : 1000;
                    if (dailyStayDuration >= 1 * 60 * 60 * 1000) {
                        jservices = 0;
                        avservices = 0;
                        var hoursInRange = Math.ceil((dailyStayDuration - 0 * 60 * 60 * 1000) / (60 * 60 * 1000));
                        jservices += 100 * hoursInRange;
                        avservices += 100 * hoursInRange;
                    }
                } else {
                    if (dailyStayDuration > 10 * 60 * 60 * 1000) {
                        var extraHours = Math.ceil((dailyStayDuration - 10 * 60 * 60 * 1000) / (60 * 60 * 1000));
                        timeLimit = 0;
                        jservices = 0;
                        avservices = 0;
                        jservices += 100 * extraHours;
                        avservices += 100 * extraHours;
                        timeLimit += 500 * extraHours;
                    }
                }
            }
        }
        var totalNonHolidayTimeRate = timeRateNonHoliday * numberOfNonHolidays;
        var totalHolidayTimeRate = timeRateHoliday * numberOfHolidays;
        var totalTimeRate = totalNonHolidayTimeRate + totalHolidayTimeRate;
        var total_holiday_Jservices = holidayJServices * numberOfHolidays;
        var total_holiday_Avservices = holidayAvServices * numberOfHolidays;
        var totalHolidayBaseRate = baseHolidayRate * numberOfHolidays;
        var totalHoliday = totalHolidayBaseRate;
        var jServicesTotal = jservices * numberOfDays;
        var avServicesTotal = avservices * numberOfDays;
        var totaljServices = jServicesTotal + total_holiday_Jservices;
        var totalAvServices = avServicesTotal + total_holiday_Avservices;
        var totalBaseRate = baseRate * numberOfDays;
        var totalTimeLimit = timeLimit * numberOfNonHolidays;
        var totalHolidayTimeLimit = timeLimitHoliday * numberOfHolidays;
        var wholeTotalTimeLimit = totalTimeLimit + timeLimitHoliday;
        var baseRateTotal = totalBaseRate + totaljServices + totalAvServices + totalTimeLimit + totalHolidayTimeLimit + totalTimeRate;
        totalRate = baseRateTotal;
        $('#timerate').val(totalTimeRate.toFixed(2));
        $('#janitorservices').val(totaljServices.toFixed(2));
        $('#avservices').val(totalAvServices.toFixed(2));
        $('#extracharge').val(wholeTotalTimeLimit.toFixed(2));

        if (hasLetterDftcHall === "Yes") {
            $('#totalAmountHallDftc').val('FREE');
            return; // Exit calculation
        }else{
            $('#totalAmountHallDftc').val(totalRate.toFixed(2));
        }
    }
    $('#rateHallDftc, #capacityHallDftc, #checkInDateHallDftc, #checkOutDateHallDftc, #arrivalHallDftc, #departureHallDftc, #hasLetterHallDftc').on('change', computeTotalAmountDftcHallAdminGH);
    $('input[name="hasLetterHallDftc"]').on('change', computeTotalAmountDftcHallAdminGH);
    $(document).on('click', '#submitButtonDFTCHall', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultDFTCHall')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        var numOfMale = parseInt($('#numOfMaleHallDftc').val());
        var numOfFemale = parseInt($('#numOfFemaleHallDftc').val());
        if(numOfFemale == 0 && numOfMale == 0){
            $('#error-messageDftcHall').html("<strong>Validation Error!</strong> <br><br> You must have at least one female guest or male guest!").show();
                $('#submitButtonDFTCHall').attr('disabled', false);
                setTimeout(function () {
                    $('#error-messageDftcHall').fadeOut('slow', function () {
                        $(this).hide();
                    });
                }, 3000);
                $('#dftcHallTerms').modal('hide');
            return;
        }
        let formData = new FormData($('#dftcHall-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminGHBookingDftcHall',
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
                    $('#dftcHallTerms').modal('hide');
                    Swal.close();
                    let errorMessages = '';
                    for (let key in response.message) {
                        if (response.message[key] && Array.isArray(response.message[key])) {
                            errorMessages += response.message[key].join('<br>') + '<br>';
                        }
                    }
                    $('#error-messageDftcHall').html("<strong>Validation Error!</strong> <br><br>" + errorMessages).show();
                    $('#submitButtonDFTCHall').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-messageDftcHall').fadeOut('slow', function () {
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
                    $('#submitButtonDFTCHall').attr('disabled', false);
                    window.location = "/adminGH/view-my-ongoing-DFTC-pre-reservations";
                });
                }
            },
            error: function(error){
                console.log(error);

            }
        });
    });
    $('#positionHallDftc').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#letterInputCellHallDftc').show();
        } else {
            $('#letterInputCellHallDftc').hide();
        }
    });
    $('#positionHallDftc').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("room_numberHallDftc");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataDftcHallAdminGH(roomNumber);
        });
    }
});
function fetchRoomDataDftcHallAdminGH(roomNumber) {

    $.ajax({
        url: '/get-room-dataDftcHallAdminGH',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#baserateHallDftc').val(data.room_baserate);
            $('#rateHallDftc').val(data.room_rate);
            $('#capacityHallDftc').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#rateHallDftc').val('');
            $('#capacityHallDftc').val('');
            $('#checkInDateHallDftc').val('');
            $('#checkOutDateHallDftc').val('');
            $('#arrivalHallDftc').val('');
            $('#departureHallDftc').val('');
            $('#numberOfDaysHallDftc').val('');
            $('#numberOfNightsHallDftc').val('');
            $('#totalAmountHallDftc').val('');
        }
    });
}

