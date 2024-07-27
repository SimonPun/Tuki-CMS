<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMwWv3fI6Vb2qUVbRit6vJ2xJf3cuV/Zl9tC5" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9745dbc339.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

</head>

<body>
    <div class="wrapper">
        <div class="title"><span>Admin Login</span></div>
        <form action="{{ route('admin.auth.login') }}" method="POST">
            @csrf <!-- CSRF Token for security -->

            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="email" placeholder="Email" required value="{{ old('email') }}" />
            </div>

            <div class="row">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required />
            </div>

            <div class="pass"><a href="#">Forgot password?</a></div>

            <div class="row button">
                <input type="submit" value="Login" />
            </div>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</body>

</html>
