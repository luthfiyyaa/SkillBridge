@extends('layouts.app')

@section('content')

<style>
    body {
        background: #efefef;
        font-family: 'Poppins', sans-serif;
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
        margin: 80px auto;
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
        flex-direction: column;
        gap: 20px;
    }

    .profile-details {
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

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        background-color: #6096ba;
        color: white;
        font-weight: bold;
        transition: background 0.3s;
        align-self: flex-end;
    }

    .btn:hover {
        background-color: #4a7ba5;
    }
</style>

<div class="profile-container">
    <h1>Profil Mentor</h1>
    <div class="profile-card">
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
                <strong>
                    @php $full = floor($mentor->rating); @endphp
                    @for($i = 0; $i < $full; $i++)
                        ★
                    @endfor
                    @if($mentor->rating > $full)
                        ☆
                    @endif
                </strong>
            </div>
        </div>

        <a href="{{ route('mentoring.request', $mentor->id) }}" class="btn">Ajukan Mentoring</a>
    </div>
</div>

@endsection
