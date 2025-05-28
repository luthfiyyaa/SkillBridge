@extends('layouts.app')

@section('content')
<style>
    body {
        background: #efefef;
        font-family: 'Poppins', sans-serif;
    }

    .header {
        color: #274c77;
        padding: 1.5rem 1rem;
        text-align: center;
        font-size: 2rem;
        font-weight: 600;
    }

    .lowongan-card {
        background: #ffffff;
        border-radius: 1rem;
        padding: 1.5rem;
        margin: 1.25rem auto;
        max-width: 800px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .lowongan-card:hover {
        transform: translateY(-4px);
    }

    .info {
        flex: 1;
    }

    .info .title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
        color: #003459;
    }

    .info p {
        margin: 0.2rem 0;
        font-size: 0.95rem;
    }

    .detail-btn {
        align-self: flex-end;
        background: #6096ba;
        color: white;
        padding: 0.6rem 1.4rem;
        border-radius: 2rem;
        border: none;
        font-weight: 500;
        font-size: 0.95rem;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .detail-btn:hover {
        background: #2d536c;
    }

    @media (min-width: 600px) {
        .lowongan-card {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .detail-btn {
            margin-left: 2rem;
        }
    }
</style>

<div class="header">Lowongan Rekomendasi</div>

@foreach ($lowongans as $lowongan)
    <div class="lowongan-card">
        <div class="info">
            <p class="title">{{ $lowongan->title }}</p>
            <p>{{ $lowongan->company }}</p>
            <p>📍 {{ $lowongan->location }}</p>
            <p>💰 {{ $lowongan->salary }}</p>
        </div>
        <a href="{{ route('detail.lowongan', ['id' => $lowongan->id]) }}" class="detail-btn">Detail</a>
    </div>
@endforeach
@endsection
