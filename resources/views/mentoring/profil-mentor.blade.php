@extends('layouts.app') {{-- Sesuaikan dengan layout utama --}}
@section('content')

<style>
    body {
        background: #EDF2FA;
        font-family: Inter, sans-serif;
    }
    .header {
        width: 100%;
        height: 117px;
        background: #ABC4FF;
        box-shadow: 0px 4px 250px rgba(0, 0, 0, 0.25);
        position: relative;
    }

    .profile-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        background-color: #e6ecf5;
        border-radius: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .profile-container h1 {
        text-align: center;
        font-size: 36px;
        color: #3b5edb;
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


<div class="profile-container">
    <h1>Profil Mentor</h1>
    <div class="profile-card">
        <div class="profile-image">
            <img src="{{ asset('storage/' . $mentor->foto) }}" alt="Foto Profil">
        </div>
        <div class="profile-details">
            <div class="detail-row">
                <span>Nama Lengkap</span>
                <strong>{{ $mentor->nama }}</strong>
            </div>
            <div class="detail-row">
                <span>Bidang Keahlian</span>
                <strong>{{ $mentor->bidang }}</strong>
            </div>
            <div class="detail-row">
                <span>Ketersediaan</span>
                <strong>{{ $mentor->ketersediaan }}</strong>
            </div>
            <div class="detail-row">
                <span>Rating</span>
                @php $full = floor($mentor->rating); @endphp
                    @for($i = 0; $i < $full; $i++)
                        ★
                    @endfor
                    @if($mentor->rating > $full)
                        ☆
                    @endif
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
