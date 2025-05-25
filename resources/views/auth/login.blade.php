<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Inter, sans-serif;
            background: #EDF2FA;
        }

        .login-card {
            width: 544px;
            height: 500px;
            background: #CCDBFD;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 28px;
            padding: 30px;
            margin: 100px auto;
            box-sizing: border-box;
        }

        .login-title {
            text-align: center;
            color: #425CB8;
            font-size: 50px;
            font-weight: 700;
            margin-bottom: 40px;
            text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            height: 40px;
            margin-bottom: 25px;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            font-size: 20px;
        }

        .remember-me {
            align-self: flex-start;
            display: flex;
            align-items: left;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .login-form button {
            width: 174px;
            height: 52px;
            background: #425CB8;
            border: none;
            border-radius: 13px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .extra-links {
            font-size: 15px;
            color: black;
        }

        .extra-links a {
            text-decoration: none;
            color: black;
        }

    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')

    <div class="login-card">
        <div class="login-title">Log In!</div>

        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Log In</button>

            <div class="extra-links">
                <a href="{{ route('password.request') }}">Lupa Password</a> |
                <a href="{{ route('register') }}">Registrasi</a>
            </div>
        </form>
    </div>
    @endsection
</body>
</html>
