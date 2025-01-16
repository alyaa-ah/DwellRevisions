<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h3 {
            color: #555;
        }

        h1 {
            color: #007bff;
            font-size: 36px;
            margin: 20px 0;
        }

        h4, h6 {
            color: #555;
            margin: 10px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Dear {{ $fullname }},</h3>
        <h4>We are committed to keeping your account secure. Your new password has been successfully generated:</h4>
        <h1>{{ $password }}</h1>
        <h6>For your security, we recommend memorizing this password and storing it safely.</h6>
        <h4>Thank you for being a valued member of our community. We wish you a wonderful day ahead!</h4>
        <h4>If you did not request a password reset, please contact our support team immediately.</h4>
        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #555;">
            Best regards,<br>
            The Team<br>
            <br>
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/Logo.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
            <img src="{{ url('https://dwell.sharvilclass.com/public/images/STREAMLINEFINAL.png') }}" alt="footer-logo" style="max-width: 150px; margin-top: 10px; height: auto;">
        </div>
    </div>

</body>
</html>
