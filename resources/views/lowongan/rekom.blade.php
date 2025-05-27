@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f5faff;
    }

    .header {
        background: #00A7E1;
        color: white;
        padding: 1rem;
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
    }

    .lowongan-card {
        background: #cfe0ff;
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1rem auto;
        max-width: 800px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .lowongan-left {
        display: flex;
        align-items: center;
    } 

    .detail-btn {
        background: #003459;
        color: white;
        padding: 0.5rem 1.2rem;
        border-radius: 1rem;
        border: none;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .detail-btn:hover {
        background: #00171F;
    }

    .info p {
        margin: 0.3rem 0;
    }

    .title {
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>

<div class="header">Lowongan Rekomendasi</div>

@foreach ($lowongans as $lowongan)
    <div class="lowongan-card">
        <div class="lowongan-left">
            <div class="info">
                <p class="title">{{ $lowongan->title }}</p>
                <p>{{ $lowongan->company }}</p>
                <p>📍 {{ $lowongan->location }}</p>
                <p>💰 {{ $lowongan->salary }}</p>
            </div>
        </div>
        <a href="{{ route('detail.lowongan', ['id' => $lowongan->id]) }}" class="detail-btn">Detail</a>

    </div>
@endforeach
@endsection
