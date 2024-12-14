function viewRoom(room){
    var data = JSON.parse(room);
    $('#facilityName-modal').text(data.facility_name);
    $('#roomName-modal').text(data.room_number);
    $('#roomType-modal').text(data.room_type);
    $('#roomStatus-modal').text(data.room_status);
    $('#roomCapacity-modal').text(data.room_capacity);
    $('#roomRate-modal').text(data.room_rate);
    $('#roomDescription-modal').val(data.room_description);
    $('#roomAmenities-modal').val(data.room_amenities);
    $('#roomInclusion-modal').val(data.room_inclusion);
    var baseUrl1 = 'https://dwell.sharvilclass.com/public/photos/rooms/';
    var roomPhoto1 = encodeURIComponent(data.room_photo1); 
    var photoUrl1 = baseUrl1 + roomPhoto1;
    $('#roomPhoto1-modal').attr('src', photoUrl1);
    var roomPhoto2 = encodeURIComponent(data.room_photo2);
    var photoUrl2 = baseUrl1 + roomPhoto2;
    $('#roomPhoto2-modal').attr('src', photoUrl2);
    var roomPhoto3 = encodeURIComponent(data.room_photo3);
    var photoUrl3 = baseUrl1 + roomPhoto3;
    $('#roomPhoto3-modal').attr('src', photoUrl3);
    $('#view-room-modal').modal('show');
}
function editRoom(room){
    var data = JSON.parse(room);
    console.log(data);
    $('#room_id').val(data.id);
    $('#updateFacility').val(data.facility_id);
    var event = new Event('change');
    document.getElementById('updateFacility').dispatchEvent(event);
    $('#updateRoomType').val(data.room_type);
    $('#updateRoomNumber').val(data.room_number);
    $('#updateRoomRate').val(data.room_rate);
    $('#updateRoomStatus').val(data.room_status);
    $('#updateRoomCapacity').val(data.room_capacity);
    $('#updateRoomDescription').val(data.room_description);
    $('#updateRoomAmenities').val(data.room_amenities);
    $('#updateRoomInclusion').val(data.room_inclusion);
    $('#updateRoomPhoto1').text(data.room_photo1);
    $('#update-room-modal').modal('show');
}
function deleteRoom(room){
    var data = JSON.parse(room);
    $('#roomId').val(data.id);
    $('#delete-room-modal').modal('show');
}
$(document).ready(function(){
    $(document).on('submit', '#addRoom-form', function(event){
        event.preventDefault();
        let formData = new FormData($('#addRoom-form')['0']);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add-room-adminSH',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not add room at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                        var errorMessages = Object.values(response.message).join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Room validation failed!',
                            text: errorMessages,
                            showConfirmButton: true,
                        });
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Room successfully added!",
                    showConfirmButton: true,
                }).then(function(){
                    window.location.reload();
                });
                }
            },error: function(error){
                console.log(error);
            }
        });
    });
    $(document).on('submit', '#update-room-form', function(event){
        event.preventDefault();
        let formData = new FormData($('#update-room-form')['0']);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminSHUpdateRoom',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not add room at this time!",
                        showConfirmButton: true,
                    })
                }else if(response.message){
                        var errorMessages = Object.values(response.message).join('<br>');
                        Swal.fire({
                            icon: 'error',
                            title: 'Room validation failed!',
                            text: errorMessages,
                            showConfirmButton: true,
                        });
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "All set!",
                    text: "Room successfully modified!",
                    showConfirmButton: true,
                }).then(function(){
                    window.location.reload();
                });
                }
            },error: function(error){
                console.log(error);
            }
        });
    });
    $(document).on('submit', '#delete-room-form', function(event){
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/adminSHDeleteRoom',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if(response == 0){
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Could not delete at this time!",
                        showConfirmButton: true,
                    })
                }else{
                    Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "Room successfully deleted!",
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
});
