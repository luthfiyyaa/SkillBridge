@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        background: #efefef;
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 80px 20px 150px 20px; /* padding bawah besar untuk jarak ke footer */
        background-color: transparent;
    }

    .form-title {
        font-size: 48px;
        font-weight: 700;
        text-align: center;
        color: #274c77;
        font-family: 'Poppins', sans-serif;
        margin-bottom: 40px;
        text-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    }

    form {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-size: 16px;
        font-weight: 600;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="file"],
    select {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
    }

    .radio-group {
        display: flex;
        gap: 20px;
        margin-top: 6px;
    }

    .radio-group label {
        font-weight: normal;
        font-size: 15px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .form-actions button {
        width: 130px;
        height: 40px;
        background: #6096ba;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .form-actions button:hover {
        background: #486e88;
    }

    @media (max-width: 768px) {
        .form-actions {
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .form-actions button {
            width: 100%;
        }
    }
</style>

<div class="form-container">
    <div class="form-title">Lengkapi Data Diri</div>

    <form action="{{ url('/datadiri') }}" method="POST" enctype="multipart/form-data">
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
