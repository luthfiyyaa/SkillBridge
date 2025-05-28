@extends('layouts.app')

@section('content')
<style>
    h1 {
        font-size: 2.25rem;
        font-weight: bold;
        margin-bottom: 2rem;
        text-align: center;
        color: #274c77;
    }

    .filter-bar {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 30px;
    }

    .search-input,
    .filter-select {
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 250px;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-top: 8px;
        margin-bottom: 6px;
    }

    .card-subtitle {
        font-size: 0.9rem;
        color: #666;
    }

    .detail-button {
        background-color: #6096ba;
        color: white;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        margin-top: 14px;
        font-size: 0.9rem;
    }

    .no-results {
        text-align: center;
        color: #999;
        font-size: 1.1rem;
        margin-top: 40px;
    }
</style>

<h1>Daftar Tes</h1>

<form method="GET" action="{{ route('tests.index') }}" class="filter-bar">
    <input 
        type="text" 
        name="search" 
        placeholder="Cari Tes" 
        class="search-input" 
        value="{{ request('search') }}"
    >

    <select name="bidang" class="filter-select" onchange="this.form.submit()">
        <option value="">Filter Bidang</option>
        @foreach($bidangs as $bidang)
            <option 
                value="{{ $bidang }}" 
                {{ request('bidang') == $bidang ? 'selected' : '' }}
            >
                {{ $bidang }}
            </option>
        @endforeach
    </select>
</form>

<div class="grid">
    @forelse($tests as $test)
        <div class="card">
            <div class="card-image">Ilustrasi Tes</div>
            <div class="card-title">{{ $test->title }}</div>
            <div class="card-subtitle">{{ $test->bidang }}</div>
            <a href="{{ route('tests.show', $test->id) }}" class="detail-button">Detail Tes</a>
        </div>
    @empty
        <p class="no-results">Tidak ada tes ditemukan.</p>
    @endforelse
</div>
@endsection
