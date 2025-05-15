<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Balige Beach - Register</title>
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
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn-register {
            background: #ffba5a;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }
        .btn-register:hover {
            background: #ff9f2b;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <img src="/images/Logo.png" alt="Hotel Balige Beach">
            <h4>Create Account</h4>
            <p class="text-muted">Join us at Hotel Balige Beach</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Full Name</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Create a password">
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="fas fa-lock"></i> Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                        <label class="custom-control-label" for="terms">
                            I agree to the <a href="{{ route('terms.show') }}" target="_blank" class="text-primary">Terms of Service</a>
                            and <a href="{{ route('policy.show') }}" target="_blank" class="text-primary">Privacy Policy</a>
                        </label>
                    </div>
                </div>
            @endif

            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus"></i> Create Account
            </button>

            <div class="login-link">
                <p>Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary">
                        Login here
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
