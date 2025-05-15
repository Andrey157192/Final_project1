<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Balige Beach - Login</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #F8F4E1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-login {
            background: #ffba5a;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }
        .btn-login:hover {
            background: #ff9f2b;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="/images/Logo.png" alt="Hotel Balige Beach">
            <h4>Welcome Back!</h4>
            <p class="text-muted">Please login to your account</p>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                    <label class="custom-control-label" for="remember_me">Remember me</label>
                </div>
            </div>

            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}" class="text-primary">
                        Forgot your password?
                    </a>
                </div>
            @endif

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <div class="register-link">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="text-primary">
                        Register here
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
