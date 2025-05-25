@extends('layouts.app')

@section('title', $test->title)

<style>
    #detail-test-page {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #eef3f9;
        padding: 30px;
    }

    #detail-test-page h1 {
        font-size: 34px;
        margin-bottom: 10px;
        color: #0d47a1;
    }

    #detail-test-page p {
        font-size: 18px;
        margin: 10px 0;
        color: #333;
    }

    #detail-test-page img {
        display: block;
        margin: 20px 0;
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    #detail-test-page a.kembali-link {
        color: #6a1b9a;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
        display: inline-block;
    }

    #detail-test-page .btn-mulai-tes {
        display: inline-block;
        background-color: #43a047;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    #detail-test-page .btn-mulai-tes:hover {
        background-color: #388e3c;
    }
</style>

@section('content')
<div id="detail-test-page">
    <h1>{{ $test->title }}</h1>

    <p><strong>Bidang:</strong> {{ $test->bidang }}</p>

    <img 
        src="{{ asset('storage/' . $test->image) }}" 
        alt="Ilustrasi Tes" 
        width="300"
    />

    <p>{{ $test->description }}</p>

    <a href="{{ route('tests.index') }}" class="kembali-link">← Kembali</a>

    {{-- Tombol Mulai Tes --}}
    <div style="margin-top: 20px;">
        <a href="{{ url('/soal-test?test_id=' . $test->id) }}" class="btn-mulai-tes">Mulai Tes</a>
    </div>
</div>
@endsection
