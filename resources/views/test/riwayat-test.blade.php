@extends('layouts.app')

@section('title', 'Riwayat Tes')

@section('content')
<style>
    .history-container {
        padding: 40px;
        background: linear-gradient(to bottom right, #e3eefe, #f3f8ff);
        min-height: 100vh;
    }

    .history-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .test-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #bcd0ff;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .test-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .test-thumbnail {
        width: 60px;
        height: 60px;
        background-color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #333;
    }

    .test-text {
        display: flex;
        flex-direction: column;
        font-size: 16px;
        color: #333;
    }

    .test-score {
        background-color: #2c3e50;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 18px;
    }
</style>

<div class="history-container">
    <h2 class="text-center my-4">Riwayat Tes</h2>

    <div class="container">
        @forelse ($results as $result)
            <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">
                <div>
                    <strong>{{ $result->test->title }}</strong><br>
                    <small>Tanggal: {{ $result->created_at->format('d M Y H:i') }}</small>
                </div>
                <div>
                    <span class="btn btn-primary">{{ $result->score }}</span>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada tes yang dikerjakan.</p>
        @endforelse
    </div>

</div>
@endsection
