@extends('layouts.app')

@section('content')
<style>
    .profile-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #f4f7fc;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .section-box {
        background-color: #cfe0ff;
        border-radius: 15px;
        padding: 1rem 1.5rem;
        box-shadow: 2px 4px 5px rgba(0, 0, 0, 0.2);
        margin-bottom: 1rem;
    }
    .section-box p {
        margin: 0.25rem 0;
    }
    .section-box h3 {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .download-box {
        background-color: #cfe0ff;
        border-radius: 15px;
        padding: 1rem;
        text-align: center;
        box-shadow: 2px 4px 5px rgba(0, 0, 0, 0.2);
        margin: 0.5rem;
    }
    .download-box a {
        display: inline-block;
        margin-top: 0.5rem;
        background-color: #3f51b5;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 999px;
        text-decoration: none;
        font-weight: bold;
    }
    .edit-btn {
        background-color: #3f51b5;
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        text-decoration: none;
        font-weight: bold;
        float: right;
        margin-top: 2rem;
    }
</style>
<div class="profile-container">
    <h1 class="text-3xl font-bold text-center mb-6">Portofolio</h1>

    <div class="section-box">
        <p><strong>Nama Lengkap</strong> : {{ $porto->nama }}</p>
        <p><strong>Email</strong> : {{ $porto->email }}</p>
        <p><strong>Nomor Telepon</strong> : {{ $porto->telepon }}</p>
        <p><strong>Bidang Keahlian</strong> : {{ $porto->bidang }}</p>
        <p><strong>LinkedIn</strong> : <a href="{{ $porto->linkedin }}" target="_blank">{{ $porto->linkedin }}</a></p>
    </div>

    <div class="section-box">
        <h3>Deskripsi</h3>
        <p>{{ $porto->deskripsi }}</p>
    </div>

    <div class="flex flex-wrap justify-center">
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