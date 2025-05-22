@extends('layouts.app')

@section('content')
    <h2>Ajukan Mentoring dengan {{ $mentor->nama }}</h2>
    <p>Bidang: {{ $mentor->bidang }}</p>
    <form action="#" method="POST">
        @csrf
        <label for="topik">Topik Mentoring:</label>
        <input type="text" id="topik" name="topik" required>
        <br>
        <button type="submit">Ajukan</button>
    </form>
    <a href="{{ route('mentoring.request', $mentor->id) }}">Ajukan Mentoring</a>
@endsection
