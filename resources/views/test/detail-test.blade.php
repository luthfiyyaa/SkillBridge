@extends('layouts.app')

@section('title', $test->title)

@section('content')
<h1>{{ $test->title }}</h1>

<p><strong>Bidang:</strong> {{ $test->bidang }}</p>

<img 
    src="{{ asset('storage/' . $test->image) }}" 
    alt="Ilustrasi Tes" 
    width="300"
/>

<p>{{ $test->description }}</p>

<a href="{{ route('tests.index') }}">← Kembali</a>

{{-- Tombol Mulai Tes --}}
<div style="margin-top: 20px;">
    <a href="{{ url('/soal-test?test_id=' . $test->id) }}" class="btn-mulai-tes">Mulai Tes</a>
</div>

<style>
    .btn-mulai-tes {
        display: inline-block;
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-mulai-tes:hover {
        background-color: #45a049;
    }
</style>
@endsection
