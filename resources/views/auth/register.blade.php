<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jurnal 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
        .form-group { margin-bottom: 12px; }
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
        .btn-register {
            width: 100%;
            background: #555;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 12px;
            font-size: 14px;
            letter-spacing: 0.1em;
            cursor: pointer;
            margin-top: 8px;
            margin-bottom: 16px;
        }
        .btn-register:hover { background: #444; }
        .login-link {
            text-align: center;
            color: #666;
            font-size: 13px;