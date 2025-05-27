<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Registrasi</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #EFEFEF;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #EFEFEF;
    }

    .form-box {
      width: 450px;
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 4px 4px 20px rgba(0, 0, 0, 0.2);
      padding: 40px 30px;
    }

    .form-box h1 {
      text-align: center;
      color: #274c77;
      font-size: 36px;
      margin-bottom: 30px;
      text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      height: 40px;
      padding: 8px 12px;
      font-size: 14px;
      border: none;
      border-radius: 8px;
      margin-bottom: 15px;
      background-color: #b1d6ef;
    }

    .note {
      font-size: 12px;
      color: #333;
      margin-top: -10px;
      margin-bottom: 15px;
    }

    button {
      height: 45px;
      background: #6096ba;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 13px;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-top: 10px;
      width: 50%;
    }

    button:hover {
      background: #274c77;
    }

    .back-to-login {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .back-to-login a {
      color: black;
      text-decoration: underline;
    }
  </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
      <div class="form-box">
        <h1>Register Now!</h1>
      <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
        @csrf
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" required>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Password</label>
          <input type="password" id="password" name="password" required minlength="8">
          <div class="note">Minimal 8 karakter</div>

          <label for="password_confirmation">Konfirmasi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>

          <button type="submit">Daftar Sekarang</button>
        </form>

        <div class="back-to-login">
          <a href="/login">Kembali ke Login</a>
        </div>
      </div>
    </div>
  @endsection

  <script>
    function validateForm() {
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirm-password').value;

      if (password !== confirmPassword) {
        alert('Konfirmasi password tidak cocok.');
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
