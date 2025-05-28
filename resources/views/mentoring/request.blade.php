@extends('layouts.app')

<style>
.mentoring-form {
    background-color: #ffffff;
    padding: 30px 40px;
    border-radius: 8px;
    max-width: 500px;
    margin: 30px auto; /* center di layar */
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

.mentoring-form h2 {
    margin-bottom: 8px;
    color: #274c77;
}

.mentoring-form p {
    margin-bottom: 20px;
    color: #555;
}

.mentoring-form form label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #333;
}

.mentoring-form input[type="text"],
.mentoring-form input[type="email"],
.mentoring-form input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 4px;
    border: 1px solid #a3cef1;
    box-sizing: border-box;
    font-size: 14px;
}

.mentoring-form button {
    margin-top: 25px;
    padding: 12px 20px;
    width: 100%;
    background-color: #6096ba;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.mentoring-form button:hover {
    background-color: #416f8d;
}
</style>

@section('content')
<div class="mentoring-form">
    <h2>Ajukan Mentoring dengan {{ $mentor->nama }}</h2>
    <p>Bidang: {{ $mentor->bidang }}</p>

    <form action="{{ route('mentoring.store') }}" method="POST">
        @csrf
        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">

        <label for="nama_pemohon">Nama Pemohon:</label>
        <input type="text" id="nama_pemohon" name="nama_pemohon" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="pesan">Topik Mentoring:</label>
        <input type="text" id="pesan" name="pesan" required>

        <label for="tanggal">Tanggal Mentoring:</label>
        <input type="date" id="tanggal" name="tanggal" required>

        <button type="submit">Ajukan</button>
    </form>
</div>
@endsection
