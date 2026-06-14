<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jurnal 2026</title>
   
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #1a1a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Georgia', serif;
        }
        .container {
            width: 100%;
            max-width: 420px;
            padding: 24px;
        }
        h1 {
            color: #fff;
            font-size: 36px;
            font-weight: 400;
            text-align: center;
            margin-bottom: 32px;
            letter-spacing: 0.02em;
        }
        .card {
            background: #d4d0cb;
            border-radius: 20px;
            padding: 32px 28px;
        }
        .book-icon {
            text-align: center;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 12px;
        }
        input {
            width: 100%;
            background: #555;
            border: none;
            border-radius: 20px;
            padding: 12px 18px;
            color: #fff;
            font-size: 14px;
            outline: none;
        }
        input::placeholder { color: #bbb; }
        .forgot {
            text-align: right;
            margin-bottom: 20px;
        }
        .forgot a {
            color: #666;
            font-size: 12px;
            text-decoration: none;
        }
        .btn-login {
            width: 100%;
            background: #555;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 12px;
            font-size: 14px;
            letter-spacing: 0.1em;
            cursor: pointer;
            margin-bottom: 16px;
        }
        .btn-login:hover { background: #444; }
        .register-link {
            text-align: center;
            color: #666;
            font-size: 13px;
        }
        .register-link a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
        .error-msg {
            background: #ff6b6b22;
            border: 1px solid #ff6b6b55;
            color: #ff6b6b;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .remember input { width: auto; }
        .remember label { color: #555; font-size: 13px; font-family: sans-serif; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <div class="card">
            <div class="book-icon">📓</div>

            @if ($errors->any())
                <div class="error-msg">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email"
                        value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <div class="forgot">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>
                <button type="submit" class="btn-login">LANJUT</button>
                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>