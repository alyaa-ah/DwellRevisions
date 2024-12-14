function viewAccountAdminGH(client){
    var data = JSON.parse(client);
    $('#fullNameAccount-modal').text(data.fullname);
    $('#usernameAccount-modal').text(data.username);
    $('#emailAccount-modal').text(data.email);
    $('#contactAccount-modal').text(data.contact);
    $('#positionAccount-modal').text(data.position);
    $('#homeAddressAccount-modal').text(data.address);
    $('#institutionAccount-modal').text(data.agency);
    $('#roleAccount-modal').text(data.role);
    $('#statusAccount-modal').text(data.status);
    $('#view-account-modal').modal('show');
}
function editAccountAdminGH(client){
    var data = JSON.parse(client);
    $('#clientID').val(data.id);
    $('#edit-fullname-account').val(data.fullname);
    $('#edit-username-account').val(data.username);
    $('#edit-position-account').val(data.position);
    $('#edit-email-account').val(data.email);
    $('#edit-contact-account').val(data.contact);
    $('#edit-address-account').val(data.address);
    $('#edit-agency-account').val(data.agency);
    $('#edit-account-modal').modal('show');
}
$(document).ready(function() {
    $(document).on('submit', '#edit-account-form', function(event) {
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "adminGHEditAccount",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response.status === 404){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not modify account at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                    var errorMessages = Object.values(response.message).join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Modify validation failed!',
                        html: errorMessages,
                        showConfirmButton: true,
                    });
                }else if(response == 2){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Old password is incorrect",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Account successfully modified!",
                    showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                        $('#edit-account-modal').modal('hide');
                    });
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    });
});
