@extends('layouts.app')

@section('title', $test->title)

<style>
    #detail-test-page {
        font-family: 'Poppins', sans-serif;
        background-color: #efefef;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
    }

    .detail-container {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        width: 100%;
        text-align: center;
    }

    .detail-container h1 {
        font-size: 34px;
        margin-bottom: 16px;
        color: #0d47a1;
    }

    .detail-container p {
        font-size: 18px;
        margin: 12px 0;
        color: #333;
    }

    .detail-container img {
        margin: 20px auto;
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-mulai-tes {
        background-color: #6096ba;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        transition: background-color 0.3s ease;
        margin-top: 30px;
    }

    .btn-mulai-tes:hover {
        background-color: #8bc2e7;
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
    }
</style>

@section('content')
<div id="detail-test-page">
    <div class="detail-container">
        <h1>{{ $test->title }}</h1>

        <p><strong>Bidang:</strong> {{ $test->bidang }}</p>

        <img 
            src="{{ asset('storage/' . $test->image) }}" 
            alt="Ilustrasi Tes" 
        />

        <p>{{ $test->description }}</p>

        {{-- Tombol Mulai Tes --}}
        <div class="button-container">
            <a href="{{ route('tes.start', ['test_id' => $test->id]) }}" class="btn-mulai-tes">
                Mulai Tes
            </a>
        </div>
    </div>
</div>
@endsection
