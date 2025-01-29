function makeRatingsGuestHouse(booking){
    var data = JSON.parse(booking);
    $('#client_rating_id').val(data.id);
    $('#rating-guesthouse-booking-modal').modal('show');
}
function makeRatingsStaffHouse(booking){
    var data = JSON.parse(booking);
    $('#client_rating_id_staffHouse').val(data.id);
    $('#rating-staffHouse-booking-modal').modal('show');
}
function makeRatingsDftc(booking){
    var data = JSON.parse(booking);
    $('#client_rating_id_DFTC').val(data.id);
    $('#rating-DFTC-booking-modal').modal('show');
}
function viewRatingsGuestHouse(booking){
    var data = JSON.parse(booking);
    $('#ratingGuestHouseModal').text(data.ratings);
    $('#feedbackGuestHouseModal').text(data.feedbacks);
    $('#view-rating-guesthouse-booking-modal').modal('show');
}
function viewRatingsStaffHouse(booking){
    var data = JSON.parse(booking);
    $('#ratingStaffHouseModal').text(data.ratings);
    $('#feedbackStaffHouseModal').text(data.feedbacks);
    $('#view-rating-staffHouse-booking-modal').modal('show');
}
function viewRatingsDftc(booking){
    var data = JSON.parse(booking);
    $('#ratingDftcModal').text(data.ratings);
    $('#feedbackDftcModal').text(data.feedbacks);
    $('#view-rating-DFTC-booking-modal').modal('show');
}
$(document).on('submit', '#rating-clientGuestHouse', function(event) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "Once submitted, your rating and comment cannot be altered!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData($('#rating-clientGuestHouse')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/clientRatingGuestHouseBooking',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Could not rate at this time!",
                            showConfirmButton: true,
                        });
                    } else if (response.status == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "All set!",
                            text: response.message,
                            showConfirmButton: true,
                        }).then(function() {
                            window.location = "/client/view-guesthouse-rooms";
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            Swal.fire({
                icon: "info",
                title: "Submission canceled",
                text: "You can still review and modify your rating and comment before submitting.",
                showConfirmButton: true,
            });
        }
    });
});
$(document).on('submit', '#rating-clientStaffHouse', function(event) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "Once submitted, your rating and comment cannot be altered!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData($('#rating-clientStaffHouse')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/clientRatingStaffHouseBooking',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Could not rate at this time!",
                            showConfirmButton: true,
                        });
                    } else if (response.status == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "All set!",
                            text: response.message,
                            showConfirmButton: true,
                        }).then(function() {
                            window.location = "/client/view-staffhouse-rooms";
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {n
            Swal.fire({
                icon: "info",
                title: "Submission canceled",
                text: "You can still review and modify your rating and comment before submitting.",
                showConfirmButton: true,
            });
        }
    });
});
$(document).on('submit', '#rating-clientDftc', function(event) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "Once submitted, your rating and comment cannot be altered!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData($('#rating-clientDftc')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/clientRatingDftcBooking',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Could not rate at this time!",
                            showConfirmButton: true,
                        });
                    } else if (response.status == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "All set!",
                            text: response.message,
                            showConfirmButton: true,
                        }).then(function() {
                            window.location = "/client/view-DFTC-rooms";
                        });
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            Swal.fire({
                icon: "info",
                title: "Submission canceled",
                text: "You can still review and modify your rating and comment before submitting.",
                showConfirmButton: true,
            });
        }
    });
});

