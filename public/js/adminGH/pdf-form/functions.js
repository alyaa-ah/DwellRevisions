function generateAdminGHPdfGuestHouseBooking(booking) {
    var data = JSON.parse(booking);
    var jsonData = JSON.stringify(data);
    $.ajax({
        url: 'adminGHStaffHouseBookingPdf-form',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: jsonData,
        xhrFields: {
            responseType: 'blob'
        },
        beforeSend: function() {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we process your request into pdf form.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function(response, status, xhr){
            Swal.fire({
                icon: "success",
                title: "All set!",
                text: "You will now be directed to another page.",
                showConfirmButton: true,
            }).then(function(){
                var contentType = xhr.getResponseHeader('content-type') || 'application/pdf';
                var blob = new Blob([response], { type: contentType });
                var url = window.URL.createObjectURL(blob);
                var newWindow = window.open(url, '_blank');
                newWindow.focus();
                Swal.close();
            });
        },
        error: function(xhr, status, error){
            console.error('Request failed');
            console.log(xhr.statusText);
            alert('Failed to generate PDF. Please try again later.');
        }
    });
}
function generateAdminGHPdfStaffHouseBooking(booking) {
    var data = JSON.parse(booking);
    var jsonData = JSON.stringify(data);
    $.ajax({
        url: 'AdminGHStaffHouseBookingPdf-form',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: jsonData,
        xhrFields: {
            responseType: 'blob'
        },
        beforeSend: function() {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we process your request into pdf form.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function(response, status, xhr){
            Swal.fire({
                icon: "success",
                title: "All set!",
                text: "You will now be directed to another page.",
                showConfirmButton: true,
            }).then(function(){
                var contentType = xhr.getResponseHeader('content-type') || 'application/pdf';
                var blob = new Blob([response], { type: contentType });
                var url = window.URL.createObjectURL(blob);
                var newWindow = window.open(url, '_blank');
                newWindow.focus();
                Swal.close();
            });
        },
        error: function(xhr, status, error){
            console.error('Request failed');
            console.log(xhr.statusText);
            alert('Failed to generate PDF. Please try again later.');
        }
    });
}
function generateAdminGHPdfDftcBooking(booking) {
    var data = JSON.parse(booking);
    var jsonData = JSON.stringify(data);
    $.ajax({
        url: 'adminGHDftcBookingPdf-form',
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: jsonData,
        xhrFields: {
            responseType: 'blob'
        },
        beforeSend: function() {
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we process your request into pdf form.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function(response, status, xhr){
            Swal.fire({
                icon: "success",
                title: "All set!",
                text: "You will now be directed to another page.",
                showConfirmButton: true,
            }).then(function(){
                var contentType = xhr.getResponseHeader('content-type') || 'application/pdf';
                var blob = new Blob([response], { type: contentType });
                var url = window.URL.createObjectURL(blob);
                var newWindow = window.open(url, '_blank');
                newWindow.focus();
                Swal.close();
            });
        },
        error: function(xhr, status, error){
            console.error('Request failed');
            console.log(xhr.statusText);
            alert('Failed to generate PDF. Please try again later.');
        }
    });
}
