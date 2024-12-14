<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ $title }}</title>
    <style>
       body {
            font-family: Calibri, sans-serif;
        }
        .container-fluid {
            margin: 20px;
        }
        .title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Custom class to remove borders */
        .no-border th,
        .no-border td {
            border: none;
        }
        .no-border thead th {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <table class="no-border">
                    <thead>
                        <tr>
                            <th style="text-align: right;">
                                <img style="width: 140px; height: 150px; margin: 0 auto;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/nvsu-logo1.png'))) }}" alt="logo">
                            </th>
                            <th style="text-align: center;" width="35%">
                                <p style="margin: 0;">Republic of the Philippines</p>
                                <br>
                                <p style="margin: 0;">Nueva Vizcaya State University</p>
                                <p style="margin: 0;">Bayombong Campus</p>
                                <p style="margin: 0;">Bayombong, Nueva Vizcaya, Philippines, 3700</p>
                                <br>
                                <p style="margin: 0;">Auxilliary Services Program Office</p>
                            </th>
                            <th style="text-align: left;">
                                <img style="width: 110px; height: 110px;  margin: 0 auto;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/bp-logo.png'))) }}" alt="">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="title-row">
                    <h2 class="text-center">{{ $title }}</h2>
                    <h6 style="text-align: right;">{{ $date }}</h6>
                </div>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Activity</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Time Arrival</th>
                            <th>Time Departure</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                               <td>{{ $booking->fullname }}</td>
                               <td>{{ $booking->activity }}</td>
                               <td>{{ $booking->check_in_date }}</td>
                               <td>{{ $booking->check_out_date }}</td>
                               <td>{{ $booking->arrival }}</td>
                               <td>{{ $booking->departure }}</td>
                               <td>{{ $booking->total_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-3 mt-5">
                <div style="position: relative; display: inline-block;">
                    <span><u>{{ $director }}</u></span>
                    <span style="position: absolute; top: 30px; left: 0; right: 0; text-align: center;">Director</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
