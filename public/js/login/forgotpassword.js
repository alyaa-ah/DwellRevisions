$(document).ready(function () {
    $(document).on('submit', '#forgotPassword-form', function (event) {
        event.preventDefault();

        // Get the email value
        const email = $('#forgotEmailPassword').val();

        // Ask for email confirmation before proceeding
        Swal.fire({
            title: 'Confirm Email',
            text: `Is this your email address?` + email,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the AJAX request if the user confirms
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/forgotPassword',
                    method: 'POST',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('#register-btn').attr('disabled', true);
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Please wait while we process your request.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function (response) {
                        if (response == 0 || response == 500) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Could not request this time!",
                                showConfirmButton: true,
                            });
                        } else if (response.message) {
                            var errorMessages = Object.values(response.message).join('<br>');
                            Swal.fire({
                                icon: 'error',
                                title: 'Request validation failed!',
                                html: errorMessages,
                                showConfirmButton: true,
                            }).then(function () {
                                $('#register-btn').attr('disabled', false);
                            });
                        } else if (response == 200) {
                            Swal.fire({
                                icon: "success",
                                title: "All set!",
                                text: 'A password reset link has been sent to your email. Please check your inbox.',
                                showConfirmButton: true,
                            }).then(function () {
                                window.location.reload();
                                $('#forgotPassword-modal').modal('hide');
                            });
                        } else if (response == 404) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: "Email address not found!",
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else {
                // If user cancels, re-enable the button
                $('#register-btn').attr('disabled', false);
            }
        });
    });
});
