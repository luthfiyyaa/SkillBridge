@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #efefef;
    }
    .notif-container {
        max-width: 800px;
        margin: 40px auto;
    }
    .notif-card {
        border: none;
        border-left: 5px solid rgb(163, 46, 46);
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 3px 6px rgba(0,0,0,0.05);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1rem;
    }
    .notif-card.read {
        border-left-color: #198754;
        background-color: #f9f9f9;
    }
    .notif-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }
    .notif-message {
        font-size: 0.95rem;
        color: #555;
        margin: 0.25rem 0;
    }
    .notif-time {
        font-size: 0.85rem;
        color: #888;
    }
    .btn-read {
        font-size: 0.85rem;
        padding: 0.4rem 0.75rem;
        background-color: #6096ba;
        border-radius: 20px;
        color:#ffffff;
        border:1px solid #6096ba;
    }
</style>

<div class="container notif-container">
    <h2 class="mb-4 text-center text-primary">📩 Notifikasi Anda</h2>

    @if($notifikasi->isEmpty())
        <div class="alert alert-info text-center">
            Tidak ada notifikasi untuk saat ini.
        </div>
    @else
        @foreach($notifikasi as $notif)
            <div class="notif-card {{ $notif->is_read ? 'read' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="notif-title">{{ $notif->judul }}</div>
                        <div class="notif-message">{{ $notif->pesan }}</div>
                        <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="ms-3 text-end">
                        @if(!$notif->is_read)
                            <form method="POST" action="{{ route('notifikasi.baca', $notif->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-primary btn-read">Tandai Sudah Dibaca</button>
                            </form>
                        @else
                            <span class="badge bg-success">Dibaca</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
