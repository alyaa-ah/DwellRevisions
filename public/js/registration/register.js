$(document).ready(function(){
    $(document).on('click', '#register-btn', function(event){
        event.preventDefault();
        var captchaCode = $('#captchaCode').text();
        var userCaptchaInput = $('#captchaInput').val().trim();
        var termsCheckbox = document.getElementById('termsCheckbox');
        var privacyCheckbox = document.getElementById('privacyCheckbox');
        var termsNotChecked = !termsCheckbox.checked;
        var privacyNotChecked = !privacyCheckbox.checked;

        if (termsNotChecked || privacyNotChecked) {
            // alert('Please agree to both the Terms and Conditions and Privacy Policy before submitting');
            // console.log('Both checkboxes are not checked.');
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please agree to both in Terms and Conditions and Privacy Policy before submitting',
                showConfirmButton: true,
            });
        }else if (userCaptchaInput === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please enter the CAPTCHA.',
                showConfirmButton: true,
            });
            return;
        } else if (userCaptchaInput !== captchaCode) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please enter the correct CAPTCHA.',
                showConfirmButton: true,
            });

            $('#captchaInput').val('');
            $('#refreshCaptcha').click();
            return;
        }else{
            var formData = $('#registration-form').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/register-client',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#register-btn').attr('disabled', true);
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait while we process your registration.',
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
                            text: "Could not register at this time!",
                            showConfirmButton: true,
                        })
                    }else if(response.message){
                            var errorMessages = Object.values(response.message).join('<br>');
                            Swal.fire({
                                icon: 'error',
                                title: 'Registration validation failed!',
                                html: errorMessages,
                                showConfirmButton: true,
                            }).then(function() {
                                $('#register-btn').attr('disabled', false);
                            });
                    }else{
                        Swal.fire({
                        icon: "success",
                        title: "All set!",
                        text: "You can now check your password on your gmail account!",
                        showConfirmButton: true,
                        }).then(function(){
                            window.location.reload();
                            $('#registerModal').modal('hide');
                        });
                    }
                },error: function(error){
                    console.log(error);
                }
            });
        }
    });
});
