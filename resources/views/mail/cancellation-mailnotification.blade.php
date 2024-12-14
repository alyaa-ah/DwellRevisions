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
        A pre-reservation of {{ $requestor }} with the number {{ $bookingNumber }} on {{ $facility }} ({{ $roomNumber }})
        has been canceled. Hence, turning its status to '{{ $status }}' with the reason/s as: {{ $reason }} <br>
        Thank you!
    </p>
</body>
</html>
