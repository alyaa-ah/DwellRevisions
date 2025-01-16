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
            background: #f7f9fc;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
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

        .reservation-details {
            font-weight: bold;
            color: #555;
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
        <h3>Dear {{ $fullname }},</h3>
        <p>
            Requestor <span class="reservation-details">{{ $requestor }}</span> has completed a pre-reservation assisted by the Director with the number
            <span class="reservation-details">{{ $bookingNumber }}</span> at <span class="reservation-details">{{ $facility }}</span> (Room:
            <span class="reservation-details">{{ $roomNumber }}</span>).
            <br><br>
            Reservation Dates: <span class="dates">From: {{ $checkInDate }} {{ $arrival }} To: {{ $checkOutDate }} {{ $departure }}</span>
            <br><br>
            Kindly prepare the room as per the reservation details above.
            <br><br>
            <h4>Thank you for your attention to this matter!</h4>
            <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
                Best regards,<br>
                The Team<br>
                <br>
                <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
                <img src="{{ url('https://dwell.sharvilclass.com/public/images/STREAMLINEFINAL.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            </div>
        </p>
    </div>
</body>
</html>
