<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Balige Beach - Forgot Password</title>
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
        .forgot-password-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }
        .forgot-password-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .forgot-password-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-reset {
            background: #ffba5a;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }
        .btn-reset:hover {
            background: #ff9f2b;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .info-text {
            text-align: center;
            color: #6c757d;
            margin-bottom: 25px;
            font-size: 0.95rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <div class="forgot-password-header">
            <img src="/images/Logo.png" alt="Hotel Balige Beach">
            <h4>Forgot Password?</h4>
        </div>

        <div class="info-text">
            Don't worry! Just enter your email address below and we'll send you a link to reset your password.
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address">
            </div>

            <button type="submit" class="btn btn-reset">
                <i class="fas fa-paper-plane"></i> Send Reset Link
            </button>

            <div class="login-link">
                <p>Remember your password? 
                    <a href="{{ route('login') }}" class="text-primary">
                        Back to Login
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
