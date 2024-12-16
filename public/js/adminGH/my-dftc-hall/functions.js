
function viewAdminGHDftcHallBooking(booking){
    var data = JSON.parse(booking);
    var total_amount = data.total_amount;
    var position = data.position;
    $('#fullNameDftcHall-modal').text(data.fullname);
    $('#emailDftcHall-modal').text(data.email);
    $('#contactDftcHall-modal').text(data.contact);
    $('#homeAddressDftcHall-modal').text(data.address);
    $('#positionDftcHall-modal').text(data.position);
    $('#agencyDftcHall-modal').text(data.agency);
    $('#datetimeFilledUpDftcHall-modal').text(data.DFTC_date);
    $('#bookingNumberDftcHall-modal').text(data.DFTC_number);
    $('#activityDftcHall-modal').text(data.activity);
    $('#roomNumberDftcHall-modal').text(data.room_number);
    $('#checkInDateDftcHall-modal').text(data.check_in_date);
    $('#checkOutDateDftcHall-modal').text(data.check_out_date);
    $('#numOfDaysDftcHall-modal').text(data.number_of_days);
    $('#numOfNightsDftcHall-modal').text(data.number_of_nights);
    $('#arrivalDftcHall-modal').text(data.arrival);
    $('#departureDftcHall-modal').text(data.departure);
    $('#numOfMalesDftcHall-modal').text(data.num_of_male);
    $('#numOfFemalesDftcHall-modal').text(data.num_of_female);
    $('#rateDftcHall-modal').text(data.rate);
    if(total_amount == 0.00 && position == 'Student'){
        $('#totalAmountDftcHall-modal').text('FREE');
    }else{
        $('#totalAmountDftcHall-modal').text(data.total_amount);
    }
    $('#specialRequestDftcHall-modal').text(data.special_request);
    $('#jServicesDftcHall-modal').text(data.janitor_services);
    $('#avServicesDftcHall-modal').text(data.av_services);
    $('#view-DftcHall-modal').modal('show');
}
function editAdminGHDftcHallBooking(booking){
    var data = JSON.parse(booking);
    $('#editIdDftcHall').val(data.id);
    $('#editFullNameDftcHall').val(data.fullname);
    $('#editPositionDftcHall').val(data.position);
    $('#editEmailDftcHall').val(data.email);
    $('#editAddressDftcHall').val(data.address);
    $('#editAgencyDftcHall').val(data.agency);
    $('#editContactDftcHall').val(data.contact);
    $('#editActivityDftcHall').val(data.activity);
    $('#editSpecialRequestDftcHall').val(data.special_request);
    var selectedPosition = $('#editPositionDftcHall').val();
    if (selectedPosition === 'Student') {
        $('#editLetterInputCellDftcHall').show();
    } else {
        $('#editLetterInputCellDftcHall').hide();
    }
    $('#edit-dftchallbooking-modal').modal('show');
}
$(document).ready(function() {
    function getCurrentPhilippineTimeEditDftcHall() {
        var now = new Date();
        var utcOffset = now.getTimezoneOffset() / 60;
        var philippineOffset = 8;
        var philippineTime = new Date(now.getTime() + (utcOffset + philippineOffset) * 3600 * 1000);
        return philippineTime;
    }

    var today = getCurrentPhilippineTimeEditDftcHall();
    var minDate = new Date(today.getTime());
    minDate.setDate(today.getDate() + 14);

    var todayString = today.toISOString().split('T')[0];
    var minDateString = minDate.toISOString().split('T')[0];

    $('#editCheckInDateDftcHall').attr('min', minDateString);
    $('#editCheckOutDateDftcHall').prop('disabled', true);

    $('#editCheckInDateDftcHall').on('change', function() {
        $('#editCheckOutDateDftcHall').val('').prop('disabled', true);

        var selectedDate = new Date($(this).val());

        if ($(this).val()) {
            $('#editCheckOutDateDftcHall').prop('disabled', false);  // Enable check-out field if check-in date is set
            var minCheckOutDate = new Date(selectedDate.getTime());
            $('#editCheckOutDateDftcHall').attr('min', minCheckOutDate.toISOString().split('T')[0]);
        }
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateDftcHall').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateDftcHall, #editCheckOutDateDftcHall, #editArrivalDftcHall, #editDepartureDftcHall').on('change', computeDaysAndNightsEditDftcHall);
    $('#editCheckInDateDftcHall').on('change', function() {
        var selectedDate = new Date($(this).val());
        var minCheckOutDate = new Date(selectedDate.getTime());
        $('#editCheckOutDateDftcHall').attr('min', minCheckOutDate.toISOString().split('T')[0]);
    });
    $('#editCheckInDateDftcHall').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    $('#editCheckOutDateDftcHall').on('keydown', function(event) {
        var allowedKeys = ['Tab', 'ArrowLeft', 'ArrowRight', 'Backspace', 'Delete', 'F5'];
        if (allowedKeys.indexOf(event.key) === -1 && !event.ctrlKey && !event.metaKey) {
            event.preventDefault();
        }
    });
    function computeDaysAndNightsEditDftcHall() {
        var checkInDate = new Date($('#editCheckInDateDftcHall').val());
        var checkOutDate = new Date($('#editCheckOutDateDftcHall').val());
        var arrivalTime = $('#editArrivalDftcHall').val();
        var departureTime = $('#editDepartureDftcHall').val();

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

        $('#editNumOfDaysDftcHall').val(numberOfDays);
        $('#editNumOfNightsDftcHall').val(numberOfNights);
    }
    $('#editCheckInDateDftcHall, #editCheckOutDateDftcHall, #editArrivalDftcHall, #editDepartureDftcHall').on('change', computeDaysAndNightsEditDftcHall);
    function isHolidayOrWeekendEditDftcHall(date) {
        var holidays = [
            '2024-01-01', '2024-03-28', '2024-03-29', '2024-04-09', '2024-05-01',
            '2024-06-12', '2024-06-17', '2024-08-26', '2024-11-30', '2024-12-25'
        ];
        var dayOfWeek = date.getDay();
        var dateString = date.toISOString().split('T')[0];
        return holidays.includes(dateString) || dayOfWeek === 0 || dayOfWeek === 6;
    }

    function computeTotalAmountEditDftcHall() {
        var baseRate = parseFloat($('#editRateDftcHall').val());
        var capacity = parseInt($('#editCapacityDftcHall').val());
        var checkInDate = new Date($('#editCheckInDateDftcHall').val());
        var checkOutDate = new Date($('#editCheckOutDateDftcHall').val());
        var arrival = $('#editArrivalDftcHall').val();
        var departure = $('#editDepartureDftcHall').val();
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
        var hasLetter = $('input[name="hasLetterDftcHallEdit"]:checked').val();
        var numberOfDays = Math.ceil((checkOutTime - checkInTime) / oneDay);
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

            if (isHolidayOrWeekendEditDftcHall(currentDay)) {
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
        $('#editTimeRateDftcHall').val(timerate.toFixed(2));
        $('#editJanitorialServicesDftcHall').val(totaljServices.toFixed(2));
        $('#editAvServicesDftcHall').val(totalAvServices.toFixed(2));
        $('#extrachargeEditDftcHall').val(wholeTotalTimeLimit.toFixed(2));

        if (hasLetter=== "Yes") {
            $('#editTotalAmountDftcHall').val('FREE');
            return;
        }else{
            $('#editTotalAmountDftcHall').val(totalRate.toFixed(2));
        }
    }
    $('#editRateDftcHall, #editCapacityDftcHall, #editCheckInDateDftcHall, #editCheckOutDateDftcHall, #editArrivalDftcHall, #editDepartureDftcHall, #editHasLetterDftcHall').on('change', computeTotalAmountEditDftcHall);
    $('input[name="hasLetterDftcHallEdit"]').on('change', computeTotalAmountEditDftcHall);
    $(document).on('click', '#submitButtonEditDftcHall', function(event){
        event.preventDefault();
        const agreeCheckbox = $('#flexCheckDefaultEditDftcHall')[0];
        if (!agreeCheckbox.checked) {
            Swal.fire({
                icon: "error",
                title: "Can't proceed!",
                text: "Please read and check the terms and condition before pre-booking!",
                showConfirmButton: true,
            })
            return;
        }
        var numOfFemale = $('#editNumOfFemaleDftcHall').val();
        var numOfMale = $('#editNumOfMalesDftcHall').val();
        if(numOfFemale == 0 && numOfMale == 0){
            $('#error-messageEditDftcHall').html("<strong>Validation Error!</strong> <br><br> You must have at least 1 male or female guests!").show();
                    setTimeout(function () {
                        $('#error-messageEditDftcHall').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
            $('#edit-dftchallbooking-modal').modal('show');
            $('#dftcTermsEditDftcHall').modal('hide');
            return;
        }
        let formData = new FormData($('#edit-dftchall-booking-form')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminGHEditBookingDftcHall',
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
                    $('#dftcTermsEditDftcHall').modal('hide');
                    $('#edit-dftchallbooking-modal').modal('show');
                    Swal.close();
                    let errorMessages = '';
                    for (let key in response.message) {
                        if (response.message[key] && Array.isArray(response.message[key])) {
                            errorMessages += response.message[key].join('<br>') + '<br>';
                        }
                    }
                    $('#error-messageEditDftcHall').html("<strong>Validation Error!</strong> <br><br>" + errorMessages).show();
                    $('#submitButtonDFTCHall').attr('disabled', false);
                    setTimeout(function () {
                        $('#error-messageEditDftcHall').fadeOut('slow', function () {
                            $(this).hide();
                        });
                    }, 3000);
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
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
    $('#editPositionDftcHall').on('change', function() {
        var selectedPosition = $(this).val();
        if (selectedPosition === 'Student') {
            $('#editLetterInputCellDftcHall').show();
        } else {
            $('#editLetterInputCellDftcHall').hide();
        }
    });
    $('#editPositionDftcHall').trigger('change');
});
document.addEventListener("DOMContentLoaded", function() {
    var roomNumberElement = document.getElementById("editRoomNumberDftcHall");
    if (roomNumberElement) {
        roomNumberElement.addEventListener("change", function() {
            var roomNumber = this.value;
            fetchRoomDataEditDftcHallAdminGH(roomNumber);
        });
    }
});
function fetchRoomDataEditDftcHallAdminGH(roomNumber) {

    $.ajax({
        url: '/get-room-dataEditDftcHallAdminGH',
        type: 'GET',
        data: {
            room_number: roomNumber
        },
        success: function(data) {
            $('#editRateDftcHall').val(data.room_rate);
            $('#editCapacityDftcHall').val(data.room_capacity);
        },
        error: function(xhr, status, error) {
            console.error(error);
            $('#editRateDftcHall').val('');
            $('#editCapacityDftcHall').val('');
            $('#editTotalAmountDftcHall').val('');
            $('#editArrivalDftcHall').val('');
            $('#editDepartureDftcHall').val('');
            $('#editCheckInDateDftcHall').val('');
            $('#editCheckOutDateDftcHall').val('');
            $('#editNumOfDaysDftcHall').val('');
            $('#editNumOfNightsDftcHall').val('');
        }
    });
}
