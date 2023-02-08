<!DOCTYPE html>
<html>
<head>
    <title>Verify your email address</title>
</head>
<body>
    <p>Hello {{ $user->first_name }},</p>
    <p>Thank you for signing up with us.</p>
    <p>Please verify your email address by clicking the link below:</p>
    <a href="{{ route('verify', $user->email_verification_token) }}">Verify Email</a>
    <p>If you did not sign up for this account, you can ignore this email.</p>
    <p>Best regards,</p>
    <p>The Team</p>
</body>
</html>
