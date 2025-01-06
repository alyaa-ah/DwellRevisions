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
            background: #eef2f3;
            color: #333;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h3 {
            color: #555;
            margin-bottom: 10px;
        }

        h4 {
            color: #555;
            margin: 10px 0;
            font-size: 16px;
        }

        h1 {
            color: #007bff;
            font-size: 32px;
            margin: 20px 0;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
            line-height: 1.6;
        }

        .btn-container {
            margin: 30px 0;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            h4 {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Welcome to Our Pre-Reservation Service, {{ $fullname }}!</h3>
        <h4>We are thrilled to have you join our community. Below are your account login credentials:</h4>
        <h1>{{ $password }}</h1>
        <h4>You can use these credentials to log in and update your password anytime through your account settings.
            <br>If you did not create this account or believe this message was sent in error, please contact our support team immediately.
        </h4>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
            Best regards,<br>
            The Team<br>
            <br>
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/STREAMLINE2.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
        </div>
    </div>
</body>
</html>
