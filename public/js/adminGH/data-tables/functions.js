$(function () {
    var table = $('#roomsAdminGhTable').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#guestHouseBookingTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#guestHousePendingBookingTableAdminGH').DataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75, 100, -1], [10, 15, 25, 50, 75, 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        },
        "ajax": {
            "url": "/guestHousePendingBookingRefresh",
            "type": "GET",
            "dataSrc": function (json) {
            // Log the entire response to the console
            console.log('Full Response:', json);

            // Log the 'data' property from the response
            console.log('Data:', json.data);

            // Return the data to DataTables
            return json.data;
        }
        },
        "columns": [
            { "data": "fullname" },
            { "data": "room_number" },
            { "data": "check_in_date" },
            { "data": "check_out_date" },
            {
                "data": "total_amount",
                "render": function(data, type, row) {
                    return (data == "0.00" && row.position == "Student") ? 'FREE' : data;
                }
            },
            {
                "data": null,
                "defaultContent": '<button type="button" class="btn btn-info view-btn"><i class="fa-solid fa-eye" style="color: BLACK;"></i></button> <button type="button" class="btn btn-warning review-btn"><i class="fa-solid fa-book" style="color: #000000;"></i></button>',
                "orderable": false,
                "class": "text-center"
            }
        ],
        "autoWidth": false,
        "processing": true,
        "serverSide": false
    });

    setInterval(function() {
        table.ajax.reload(null, false);
    }, 5000);


    $('#guestHousePendingBookingTableAdminGH').on('click', '.view-btn', function() {
        var data = table.row($(this).closest('tr')).data();
        viewGuestHousePendingBookingAdminGH(data);
    });

    $('#guestHousePendingBookingTableAdminGH').on('click', '.review-btn', function() {
        var data = table.row($(this).closest('tr')).data();
        reviewGuestHouseBookingAdminGH(data);
    });
});

$(function () {
    var table = $('#guestHouseHistoryAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#canceledGuestHouseAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#dftcBookingTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});

$(function () {
    var table = $('#staffHouseBookingTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#guestHouseHistoryTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#staffHouseHistoryTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#dftcHistoryTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#guestHouseCanceledTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#guestHouseRejectedTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#staffHouseCanceledTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#dftcCanceledTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#dftcRejectedTableAdminGH').dataTable({
        "aLengthMenu": [[10, 15, 25, 50, 75 , 100, -1],[10, 15, 25, 50, 75 , 100, "All"]],
        "pageLength": 10,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
$(function () {
    var table = $('#accountTableAdminGH').dataTable({
        "aLengthMenu": [[1],[1]],
        "pageLength": 1,
        "responsive": {
            breakpoints: [
                { name: 'xl', width: Infinity },
                { name: 'lg', width: 1200 },
                { name: 'md', width: 992 },
                { name: 'sm', width: 768 },
                { name: 'xs', width: 576 }
            ]
        }
    });
});
