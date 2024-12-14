function viewClient(client){
    var data = JSON.parse(client);
    $('#fullNameClient-modal').text(data.fullname);
    $('#emailClient-modal').text(data.email);
    $('#contactClient-modal').text(data.contact);
    $('#homeAddressClient-modal').text(data.address);
    $('#positionClient-modal').text(data.position);
    $('#institutionClient-modal').text(data.agency);
    $('#roleClient-modal').text(data.role);
    $('#statusClient-modal').text(data.status);
    $('#view-client-modal').modal('show');
}
function activateClient(client) {
    var data = JSON.parse(client);
    $('#client_id').val(data.id);
    $('#activate-client-modal').modal('show');
}
function deactivateClient(client) {
    var data = JSON.parse(client);
    $('#clientId').val(data.id);
    $('#deactivate-client-modal').modal('show');
}
function setPermissionClient(client){
    var data = JSON.parse(client);
    $('#client_ID').val(data.id);
    $('#set-permission-client-modal').modal('show');
}
$(document).ready(function() {
    $(document).on('submit', '#activate-client-form', function(event) {
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/activateClient',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Yikes!",
                        text: "Could not activate client at this time!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Client successfully activated!",
                    showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                        $('#activate-client-modal').modal('hide');
                    });
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
    $(document).on('submit', '#deactivate-client-form', function(event) {
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/deactivateClient',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Yikes!",
                        text: "Could not deactivate at this time!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All Set!",
                    text: "Client successfully deactivated!",
                    showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                        $('#deactivate-client-modal').modal('hide');
                    });
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
    $(document).on('submit', '#set-permission-client-form', function(event) {
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/superAdmin/setPermissionClient',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Yikes!",
                        text: "Could not set permission at this time!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All Set!",
                    text: "Client successfully set privileges!",
                    showConfirmButton: true,
                    }).then(function(){
                        window.location.reload();
                        $('#set-permission-client-modal').modal('hide');
                    });
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    });
});
