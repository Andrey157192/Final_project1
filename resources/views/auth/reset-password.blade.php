<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Hotel Balige Beach</title>
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
        .reset-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            margin: 20px;
        }
        .reset-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .reset-header img {
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
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-header">
            <img src="/images/Logo.png" alt="Hotel Balige Beach">
            <h4>Reset Password</h4>
            <p class="text-muted">Masukkan password baru untuk akun Anda</p>
        </div>

        <x-validation-errors class="mb-3" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email', request()->email) }}" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password Baru</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan password baru">
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn btn-reset">
                <i class="fas fa-key"></i> Reset Password
            </button>
        </form>
    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>
