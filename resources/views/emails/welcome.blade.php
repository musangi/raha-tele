<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
</head>

<body>
    <h1>Hello, {{ $user->name }}!</h1>

    <p>Thank you for registering with us. Please click the link below to activate your account:</p>

    <p>
        <a href="{{ url('/activate-account/' . $user->id) }}">
            Activate Your Account
        </a>
    </p>

    <p>We look forward to having you as part of our community.</p>

    <p>Best regards,<br>Team</p>
</body>

</html>