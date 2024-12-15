<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
            text-align: left;
        }

        h3 {
            color: #555;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            color: #555;
        }

        strong {
            color: #333;
        }

        .dates {
            color: #555;
            font-weight: bold;
        }

        br {
            margin: 8px 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Hello {{ $fullname }}!</h3>
        <p>
            Requestor <strong>{{ $requestor }}</strong> has completed a pre-reservation with the booking number
            <strong>{{ $bookingNumber }}</strong> at <strong>{{ $facility }}</strong> (Room: <strong>{{ $roomNumber }}</strong>).
            <br><br>
            Reservation Period:
            <span class="dates">From: {{ $checkInDate }} {{ $arrival }} To: {{ $checkOutDate }} {{ $departure }}</span>
            <br><br>
            You can now review the details of this pre-reservation through your account.
            <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
                <br><br>
                Thank you for your attention!
                <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            </div>
        </p>
    </div>
</body>
</html>
