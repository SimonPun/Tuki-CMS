<!DOCTYPE html>
<html>

<head>
    <title>Employee Credentials</title>
</head>

<body>
    <p>Hi {{ $name }},</p>
    <p>Your account has been created successfully. Here are your login credentials:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Regards,</p>
    <p>The Team</p>
</body>

</html>
