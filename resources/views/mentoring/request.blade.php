@extends('layouts.app')

<style>
.container {
    background-color: #f4f8ff;
    padding: 30px;
    border-radius: 8px;
}

input[type="text"], input[type="email"], button {
    padding: 10px;
    margin-top: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

button {
    background-color: #425CB8;
    color: white;
    cursor: pointer;
}
</style>


@section('content')
<div class="container">
    <h2>Ajukan Mentoring dengan {{ $mentor->nama }}</h2>
    <p>Bidang: {{ $mentor->bidang }}</p>

    <form action="{{ route('mentoring.store') }}" method="POST">

        @csrf
        <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
        
        <label>Nama Pemohon:</label>
        <input type="text" name="nama_pemohon" required> <br>

        <label>Email:</label>
        <input type="email" name="email" required> <br>

        <label>Topik Mentoring:</label>
        <input type="text" name="pesan" required> <br>

        <label>Tanggal Mentoring:</label>
        <input type="date" name="tanggal" required> <br>


        <br>

        <button type="submit">Ajukan</button>
    </form>
</div>
@endsection
