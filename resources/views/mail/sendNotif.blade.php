<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>
    <h3>Hi {{ $fullname }}!</h3>
    <p>
        Requestor {{ $requestor }} has filled up a pre-reservation with the number of {{ $bookingNumber }} on {{ $facility }} ({{ $roomNumber }})
        From: {{ $checkInDate }} {{ $arrival }} To: {{ $checkOutDate }} {{ $departure }}<br>
        You can now review it from your account. <br>
        Thank you!
    </p>
</body>
</html>
