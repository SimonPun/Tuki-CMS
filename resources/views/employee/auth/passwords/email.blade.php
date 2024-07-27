<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .forgot-password-form header {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .alert {
            margin-bottom: 20px;
        }

        .form-control {
            height: 45px;
            font-size: 16px;
        }

        .btn {
            height: 45px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forgot-password-form">
            <header>Forgot Password</header>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <input id="email" type="email" name="email" placeholder="Enter your email" required
                        autofocus class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</body>

</html>
