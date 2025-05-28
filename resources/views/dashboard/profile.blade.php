@extends('layouts.app') {{-- Sesuaikan dengan layout utama --}}
@section('content')

<style>
    body {
        background: #efefef;
        font-family: 'Poppins', sans-serif;
    }
    .header {
        width: 100%;
        height: 117px;
        background: #ffffff;
        box-shadow: 0px 4px 250px rgba(0, 0, 0, 0.25);
        position: relative;
    }

    .profile-container {
        max-width: 900px;
        height: 550px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .profile-container h1 {
        text-align: center;
        font-size: 36px;
        color: #274c77;
        margin-bottom: 30px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
    }

    .profile-card {
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }

    .profile-image img {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        object-fit: cover;
        background-color: #ccc;
        border: 2px solid #aaa;
    }

    .profile-details {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
    }

    .detail-row span {
        color: #444;
        font-weight: 500;
    }

    .detail-row strong {
        color: #000;
    }

</style>

@auth
<div class="profile-container">
    <h1>Data Diri</h1>
    <div class="profile-card">
        <div class="profile-image">
            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Profil">
        </div>
        <div class="profile-details">
            <div class="detail-row">
                <span>Nama Lengkap</span>
                <strong>{{ $profil->nama }}</strong>
            </div>
            <div class="detail-row">
                <span>Username</span>
                <strong>{{ $profil->username }}</strong>
            </div>
            <div class="detail-row">
                <span>Email</span>
                <strong>{{ $profil->email }}</strong>
            </div>
            <div class="detail-row">
                <span>Jenis Kelamin</span>
                <strong>{{ $profil->jenis_kelamin }}</strong>
            </div>
            <div class="detail-row">
                <span>Tanggal Lahir</span>
                <strong>{{ $profil->tanggal_lahir }}</strong>
            </div>
            <div class="detail-row">
                <span>Nomor HP</span>
                <strong>{{ $profil->no_hp }}</strong>
            </div>
            <div class="detail-row">
                <span>Institusi</span>
                <strong>{{ $profil->institusi }}</strong>
            </div>
            <div class="detail-row">
                <span>Bidang Minat</span>
                <strong>{{ $profil->bidang_minat }}</strong>
            </div>
        </div>
    </div>
</div>

@endauth
@endsection
