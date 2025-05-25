@extends('layouts.app')

@section('content')
<style>
    .form-box {
        background-color: #cfe0ff;
        padding: 2rem;
        border-radius: 1rem;
        margin: 0 auto;
        width: 80%;
    }
</style>
<div class="container text-center">
    <h1 class="text-3xl font-bold mb-4">Buat Postingan</h1>
    <form method="POST" action="{{ route('forum.store') }}">
        @csrf
        <div class="form-box">
            <input type="text" name="title" placeholder="Masukkan Judul" class="w-full p-2 rounded mb-2">
            <textarea name="content" placeholder="Isi Konten" class="w-full p-2 rounded" rows="5"></textarea>
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded">kirim Postingan</button>
    </form>
</div>
@endsection