<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>
    <h3>Hi {{ $fullname}}!</h3>
    <p>
        A pre-reservation of {{ $requestor }} with the number {{ $bookingNumber }} on {{ $facility }} ({{ $roomNumber }})
        has been reviewed by Admin {{ $admin }}. Hence, turning its status to '{{ $status }}'. <br>
        This pre-reservation will be added into your ongoing {{ $facility }} table. Please contact them immediately for more information. <br>
        Thank you!
    </p>
</body>
</html>
