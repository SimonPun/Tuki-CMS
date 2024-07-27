<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Bootstrap Icons for eye toggle -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form">
            <header>Login</header>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('employee.login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" name="email" placeholder="Enter your email"
                        value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Enter your password" required>
                    <i class="bi bi-eye" id="togglePassword" onclick="togglePassword()"></i> <!-- Eye icon -->
                </div>
                <a href="{{ route('password.request') }}">Forgot password?</a>
                <button type="submit" class="button">Login</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var toggleIcon = document.getElementById('togglePassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
