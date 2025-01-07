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
            padding: 25px;
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

        .status-rejected {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-reviewed {
            color: #2ecc71;
            font-weight: bold;
        }

        br {
            margin: 10px 0;
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
        <h3>Dear {{ $requestor }},</h3>
        <p>
            Your pre-reservation number <strong>{{ $bookingNumber }}</strong> for <strong>{{ $facility }}</strong>
            in room <strong>{{ $roomNumber }}</strong> has been assessed by our administrator. Based on the review, the status has been set to
            @if ($status == 'Rejected')
                <span class="status-rejected">'{{ $status }}' due to the following reason: <strong>{{ $reason }}</strong></span>
            @elseif ($status == 'Reviewed')
                <span class="status-reviewed">'{{ $status }}.'</span> You are now eligible to download and print the associated PDF, which will need signatures from the Project-In-Charge and Director.
            @endif
        </p>
        <h4>Should you have any questions or concerns, please reach out to our support team. <br>
            We’re always happy to assist you!<br></h4>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
            Best regards,<br>
            The Team<br><br>
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/STREAMLINE2.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
        </div>
    </div>
</body>
</html>
