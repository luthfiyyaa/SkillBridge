@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #efefef;
        margin: 0;
        padding: 0;
    }

    .profile-container {
        max-width: 900px;
        height: 750px;
        margin: 40px auto;
        background-color: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .section-box {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 1.2rem 1.5rem;
        box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
    }

    .section-box p {
        margin: 0.5rem 0;
        font-size: 1rem;
        line-height: 1.5;
    }

    .section-box h3 {
        font-weight: 600;
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #2b3d6e;
    }

    .download-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .download-box {
        flex: 1;
        min-width: 250px;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 1rem;
        text-align: center;
        box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.08);
    }

    .download-box strong {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1rem;
        color: #2c3e50;
    }

    .download-box p {
        font-size: 0.95rem;
        margin: 0.25rem 0;
        word-break: break-all;
    }

    .download-box a {
        display: inline-block;
        margin-top: 0.5rem;
        background-color: #6096ba;
        color: #fff;
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .download-box a:hover {
        background-color: #486e88;
    }

    .edit-btn {
        display: inline-block;
        background-color: #6096ba;
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        float: right;
        margin-top: 1rem;
        transition: background-color 0.3s ease;
    }

    .edit-btn:hover {
        background-color: #486e88;
    }

    h1.title {
        font-size: 2rem;
        font-weight: 700;
        color: #274c77;
        text-align: center;
        margin-bottom: 2rem;
    }
</style>

<div class="profile-container">
    <h1 class="title">Portofolio</h1>

    <div class="section-box">
        <p><strong>Nama Lengkap:</strong> {{ $porto->nama }}</p>
        <p><strong>Email:</strong> {{ $porto->email }}</p>
        <p><strong>Nomor Telepon:</strong> {{ $porto->telepon }}</p>
        <p><strong>Bidang Keahlian:</strong> {{ $porto->bidang }}</p>
        <p><strong>LinkedIn:</strong> <a href="{{ $porto->linkedin }}" target="_blank">{{ $porto->linkedin }}</a></p>
    </div>

    <div class="section-box">
        <h3>Deskripsi</h3>
        <p>{{ $porto->deskripsi }}</p>
    </div>

    <div class="download-container">
        <div class="download-box">
            <strong>CV Terbaru</strong>
            <p>{{ basename($porto->cv) }}</p>
            <a href="{{ asset('storage/' . $porto->cv) }}" target="_blank">Lihat</a>
        </div>
        <div class="download-box">
            <strong>Sertifikasi</strong>
            <p>{{ basename($porto->sertifikat) }}</p>
            <a href="{{ asset('storage/' . $porto->sertifikat) }}" target="_blank">Lihat</a>
        </div>
        <div class="download-box">
            <strong>Portofolio</strong>
            <p>{{ basename($porto->porto) }}</p>
            <a href="{{ asset('storage/' . $porto->porto) }}" target="_blank">Lihat</a>
        </div>
    </div>

    <a href="/edit-porto" class="edit-btn">Edit Portofolio</a>
</div>
@endsection
