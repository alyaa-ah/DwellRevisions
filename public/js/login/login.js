$(document).ready(function() {
    $(document).on('submit', '#login-form', function(event){
        event.preventDefault();
        jQuery.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/login-client',
            method: 'POST',
            data: $(this).serialize(),
                success: function(response) {
                    if(response == 1){
                        Swal.fire({
                            icon: "success",
                            title: "Logging in!",
                            text: "You will be redirected to another page.",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(function(){
                            window.location = "/superAdmin/";
                        });
                    }else if(response == 2){
                        Swal.fire({
                            icon: "success",
                            title: "Logging in!",
                            text: "You will be redirected to another page.",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(function(){
                            window.location = "/adminGH/";
                        });
                    }else if(response == 4){
                        Swal.fire({
                            icon: "success",
                            title: "Logging in!",
                            text: "You will be redirected to another page.",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(function(){
                            window.location = "/adminSH/";
                        });
                    }else if(response == 5){
                        Swal.fire({
                            icon: "success",
                            title: "Logging in!",
                            text: "You will be redirected to another page.",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(function(){
                            window.location = "/adminDftc/";
                        });
                    }else if(response == 3){
                        Swal.fire({
                            icon: "success",
                            title: "Logging in!",
                            text: "You will be redirected to another page.",
                            showConfirmButton: false,
                            timer: 3000,
                        }).then(function(){
                            window.location = "/client/";
                        });
                    }else if(response.message){
                        var errorMessages = Object.values(response.message).join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Login validation failed!',
                            html: errorMessages,
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response == 401){
                        Swal.fire({
                            icon: 'error',
                            title: 'Login failed!',
                            text: 'Invalid username or password!',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response == 404){
                        Swal.fire({
                            icon: 'error',
                            title: 'Login failed!',
                            text: 'Invalid username or password!',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response == 402){
                        Swal.fire({
                            icon: 'error',
                            title: 'Login failed!',
                            text: 'Your account was deactivated, please contact the administrator thank you!',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: 'Please try again later!',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                }

        });
    });
});
