@extends('layouts.app')

@section('title', 'Hasil Tes')

@section('content')
<style>
    #result-page {
        font-family: 'Poppins', sans-serif;
        background-color: #efefef;
        height: 500px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .result-container {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .result-container h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 20px;
    }

    .result-container p {
        font-size: 20px;
        color: #444;
        margin-bottom: 30px;
    }

    .result-container strong {
        color: #2e7d32;
    }

    .result-container a {
        display: inline-block;
        padding: 12px 24px;
        background-color: #6096ba;
        color: white;
        font-weight: 500;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .result-container a:hover {
        background-color: #94caed;
    }
</style>

<div id="result-page">
    <div class="result-container">
        <h1>Hasil Tes</h1>

        @php
            $scoreColor = $result->score >= 70 ? 'green' : 'red';
        @endphp

        <p>Skor: <strong style="color: {{ $scoreColor }}">{{ number_format($result->score, 2) }}</strong></p>


        <a href="{{ route('tests.index') }}">← Kembali ke Kategori Tes</a>
    </div>
</div>
@endsection
