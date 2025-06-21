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
        padding: 80px 20px 150px 20px;
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
    <div class="form-title">Edit Data Diri</div>

    <form action="{{ route('datadiri.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ $profil->nama }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ $profil->username }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $profil->email }}" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ $profil->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }} required>
                    Laki-laki
                </label>
                <label>
                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ $profil->jenis_kelamin == 'Perempuan' ? 'checked' : '' }} required>
                    Perempuan
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $profil->tanggal_lahir }}" required>
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor Ponsel</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ $profil->no_hp }}" required>
        </div>

        <div class="form-group">
            <label for="institusi">Institusi</label>
            <input type="text" id="institusi" name="institusi" value="{{ $profil->institusi }}" required>
        </div>

        <div class="form-group">
            <label for="bidang_minat">Bidang Minat</label>
            <input type="text" id="bidang_minat" name="bidang_minat" value="{{ $profil->bidang_minat }}" required>
        </div>

        <div class="form-group">
            <label for="foto">Upload Foto Profil (Opsional)</label>
            <input type="file" id="foto" name="foto">
            @if ($profil->foto)
                <div style="margin-top: 10px;">
                    <strong>Foto Sekarang:</strong><br>
                    <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Profil" style="width: 120px; border-radius: 10px;">
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="reset">Reset</button>
            <button type="submit">Perbarui</button>
        </div>
    </form>
</div>
@endsection
