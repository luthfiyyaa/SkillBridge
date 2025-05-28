@extends('layouts.app')

@section('title', 'Riwayat Tes')

@section('content')
<style>
    .history-container {
        padding: 40px;
        background: #efefef;
        min-height: 100vh;
    }

    .history-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #274c77;
        margin-bottom: 40px;
    }

    .test-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #ffffff;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: transform 0.2s;
    }

    .test-card:hover {
        transform: translateY(-2px);
    }

    .test-info {
        display: flex;
        flex-direction: column;
    }

    .test-info h4 {
        margin: 0;
        font-size: 20px;
        color: #2c3e50;
    }

    .test-info small {
        color: #666;
        margin-top: 4px;
    }

    .test-score {
        background-color: #6096ba;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 18px;
        min-width: 80px;
        text-align: center;
    }

    .empty-message {
        text-align: center;
        color: #888;
        margin-top: 60px;
        font-size: 18px;
    }
</style>

<div class="history-container">
    <h2 class="history-title">Riwayat Tes</h2>

    <div class="container">
        @forelse ($results as $result)
            <div class="test-card">
                <div class="test-info">
                    <h4>{{ $result->test->title }}</h4>
                    <small>Dikerjakan pada {{ $result->created_at->format('d M Y, H:i') }}</small>
                </div>
                <div class="test-score">{{ $result->score }}</div>
            </div>
        @empty
            <p class="empty-message">Belum ada tes yang dikerjakan.</p>
        @endforelse
    </div>
</div>
@endsection
