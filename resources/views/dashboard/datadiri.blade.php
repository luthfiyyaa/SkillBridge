<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Data Diri</title>
  <style>
    body {
      margin: 0;
      background: #EDF2FA;
      font-family: Inter, sans-serif;
    }
    .form-container {
      width: 1440px;
      height: 1024px;
      margin: 0 auto;
      position: relative;
    }
    .form-title {
      position: absolute;
      top: 131px;
      left: 338px;
      width: 763px;
      font-size: 64px;
      font-weight: 700;
      text-align: center;
      color: #425CB8;
      font-family: Poppins, sans-serif;
      text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    }
    form {
      position: absolute;
      top: 220px;
      left: 463px;
      width: 514px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="file"],
    select {
      width: 100%;
      height: 30px;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-size: 18px;
      color: #333;
    }
    .radio-group {
      display: flex;
      gap: 20px;
      margin-top: 8px;
    }
    .radio-group label {
      font-weight: normal;
    }
    .form-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }
    .form-actions button {
      width: 125px;
      height: 36px;
      background: #425CB8;
      border-radius: 12px;
      color: white;
      font-size: 18px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
  <div class="form-container">
    <div class="form-title">Lengkapi Data Diri</div>

    <form action="{{ url('/profil') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label>Jenis Kelamin</label>
        <div class="radio-group">
          <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
          <label><input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan</label>
        </div>
      </div>

      <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
      </div>

      <div class="form-group">
        <label for="no_hp">Nomor Ponsel</label>
        <input type="text" id="no_hp" name="no_hp" required>
      </div>

      <div class="form-group">
        <label for="institusi">Institusi</label>
        <input type="text" id="institusi" name="institusi" required>
      </div>

      <div class="form-group">
        <label for="bidang_minat">Bidang Minat</label>
        <input type="text" id="bidang_minat" name="bidang_minat" required>
      </div>

      <div class="form-group">
        <label for="foto">Upload Foto Profil</label>
        <input type="file" id="foto" name="foto">
      </div>

      <div class="form-actions">
        <button type="reset">Reset</button>
        <button type="submit">Simpan</button>
      </div>
    </form>
  </div>
  @endsection
</body>
</html>
