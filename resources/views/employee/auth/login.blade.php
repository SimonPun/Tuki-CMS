<!-- resources/views/employee/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container">
        <div class="login form">
            <header>Login</header>
            <form method="POST" action="{{ route('employee.login') }}">
                @csrf
                <input id="email" type="email" name="email" placeholder="Enter your email"
                    value="{{ old('email') }}" required autofocus>
                <input id="password" type="password" name="password" placeholder="Enter your password" required>
                <a href="#">Forgot password?</a>
                <button type="submit" class="button">Login</button>
            </form>

        </div>
    </div>
</body>

</html>
