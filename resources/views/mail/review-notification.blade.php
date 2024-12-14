<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>
    <h3>Hi {{ $requestor}}!</h3>
    <p>
        Your pre-reservation with the number {{ $bookingNumber }} on {{ $facility }} ({{ $roomNumber }})
        has been reviewed by the administrator. Hence, turning its status to
        @if ($status == 'Rejected')
            '{{ $status }}' with the reason/s as: {{ $reason }}
        @elseif ($status == 'Reviewed')
            '{{ $status }}.' You may now download and print your PDF to be signed by the Project-In-Charge and the Director.
        @endif <br>
        Thank you!
    </p>
</body>
</html>
