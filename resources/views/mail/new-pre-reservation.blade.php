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
            background: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            line-height: 1.6;
            text-align: left;
        }

        h3 {
            color: #555;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            color: #555;
        }

        .highlight {
            font-weight: bold;
            color: #007bff;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
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
            We would like to inform you that a pre-reservation by <span class="highlight">{{ $requestor }}</span> with the booking number <span class="highlight">{{ $bookingNumber }}</span>
            for <span class="highlight">{{ $facility }}</span> (Room No. <span class="highlight">{{ $roomNumber }}</span>) has been reviewed by Admin <span class="highlight">{{ $admin }}</span>.
            As a result, the status of this booking has been updated to '<span class="highlight">{{ $status }}</span>'.
        </p>
        <p>
            This pre-reservation will be reflected in your current <span class="highlight">{{ $facility }}</span> table. Should you require further details, kindly reach out to the concerned party directly.
        </p>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
            Best regards,<br>
            The Team<br>
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/STREAMLINE2.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
        </div>
    </div>

</body>
</html>
