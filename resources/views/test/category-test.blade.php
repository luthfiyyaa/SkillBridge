@extends('layouts.app')

@section('title', 'Kategori Tes')

@section('content')
<style>
    .filter-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .search-input,
    .filter-select {
        padding: 8px;
        border-radius: 12px;
        border: 1px solid #ccc;
    }

    .card {
        width: 200px;
        background-color: #e3e9ff;
        border-radius: 16px;
        padding: 12px;
        text-align: center;
        margin: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .grid {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .detail-button {
        background-color: #3f51b5;
        color: white;
        padding: 6px 10px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
    }
</style>

<h1>Kategori Tes</h1>

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
            <div>Ilustrasi Tes</div>
            <strong>{{ $test->title }}</strong><br>
            <small>{{ $test->bidang }}</small>
            <a href="{{ route('tests.show', $test->id) }}" class="detail-button">Detail Tes</a>
        </div>
    @empty
        <p>Tidak ada tes ditemukan.</p>
    @endforelse
</div>
@endsection
