@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #efefef;
    }
    .edit-container {
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 60px;
        padding-bottom: 90px;
        max-width: 900px;
        margin: 30px auto;
        height: fit-content;
    }
    .edit-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 30px;
        color: #274c77;
    }
    .edit-form input[type="text"],
    .edit-form input[type="email"],
    .edit-form input[type="url"],
    .edit-form input[type="file"] {
        width: 95%;
        align-content: center;
        padding: 12px;
        border: 1px solid #6096ba;
        border-radius: 10px;
        font-size: 1rem;
    }
    .edit-form textarea {
        width: 97%;
        align-content: center;
        padding: 12px;
        border: 1px solid #6096ba;
        border-radius: 10px;
        font-size: 1rem;
    }
    .edit-form textarea {
        resize: vertical;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-section {
        margin-bottom: 20px;
    }
    .file-row {
        background-color: #eef2f7;
        border-radius: 10px;
        padding: 15px;
    }
    .submit-btn {
        background-color: #6096ba;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        cursor: pointer;
        float: right;
    }
    .submit-btn:hover {
        background-color: #406b87;
    }
</style>

<div class="edit-container">
    <h1 class="edit-title">Edit Portofolio</h1>

    <form action="/edit-porto" method="POST" enctype="multipart/form-data" class="edit-form">
        @csrf

        <div class="form-row form-section">
            <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $porto->nama ?? '') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email', $porto->email ?? '') }}" required>
        </div>

        <div class="form-row form-section">
            <input type="text" name="telepon" placeholder="Nomor Telepon" value="{{ old('telepon', $porto->telepon ?? '') }}" required>
            <input type="text" name="bidang" placeholder="Bidang" value="{{ old('bidang', $porto->bidang ?? '') }}" required>
        </div>

        <div class="form-section">
            <textarea name="deskripsi" placeholder="Deskripsi" rows="4">{{ old('deskripsi', $porto->deskripsi ?? '') }}</textarea>
        </div>

        <div class="form-row form-section file-row">
            <div>
                <label>Upload CV Terbaru (PDF)</label>
                <input type="file" name="cv" accept="application/pdf">
            </div>
            <div>
                <label>Upload Portofolio (PDF/Link)</label>
                <input type="file" name="porto" accept="application/pdf">
            </div>
        </div>

        <div class="form-row form-section file-row">
            <div>
                <label>Upload Sertifikasi (PDF)</label>
                <input type="file" name="sertifikat" accept="application/pdf">
            </div>
            <div>
                <label>Hubungkan LinkedIn</label>
                <input type="url" name="linkedin" placeholder="LinkedIn" value="{{ old('linkedin', $porto->linkedin ?? '') }}">
            </div>
        </div>

        <button type="submit" class="submit-btn">Simpan</button>
    </form>
</div>
@endsection
