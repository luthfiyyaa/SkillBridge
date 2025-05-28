@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #efefef;
        font-family: Poppins, sans-serif;
    }

    .container {
        max-width: 700px;
        margin: 30px auto;
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        color: #274c77;
    }

    .form-box {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        width: 500px;
    }

    .form-box input[type="text"],
    .form-box textarea {
        width: 100%;
        max-width: 600px;
        padding: 0.75rem;
        border: 1px solid #6096ba;
        border-radius: 0.5rem;
        font-size: 1rem;
    }

    button[type="submit"] {
        margin-top: 1.5rem;
        background-color: #6096ba;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 0.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #2a5572;
    }
</style>

<div class="container">
    <h1>Buat Postingan</h1>
    <form method="POST" action="{{ route('forum.store') }}">
        @csrf
        <div class="form-box">
            <input type="text" name="title" placeholder="Masukkan Judul" required>
            <textarea name="content" placeholder="Isi Konten" rows="5" required></textarea>
        </div>
        <button type="submit">Kirim Postingan</button>
    </form>
</div>
@endsection
