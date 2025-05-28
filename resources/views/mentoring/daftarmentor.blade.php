@extends('layouts.app')

@section('content')
<style>
    .page-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-family: 'Poppins', sans-serif;
        color: #274c77;
    }

    .filter-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 20px;
    }

    .filter-section select,
    .filter-section input[type="text"],
    .filter-section button {
        padding: 0.5rem 1rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
    }

    .mentor-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 40px;
        background-color: #efefef;
        border-radius: 20px;
    }

    .mentor-card {
        background: white;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }

    .mentor-card:hover {
        transform: translateY(-5px);
    }

    .mentor-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .mentor-card h3 {
        font-weight: bold;
        margin: 10px 0 5px;
    }

    .mentor-card .rating {
        font-size: 20px;
        color: gold;
        margin: 10px 0;
    }

    .btn {
        display: inline-block;
        margin: 5px;
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        background-color: #6096ba;
        color: white;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn.secondary {
        background-color: #4a6fa5;
    }

    .star {
        font-size: 1.5rem;
        color: #ccc;
    }

    .star.filled {
        color: #FFD700;
    }
</style>

<div class="page-title">Daftar Mentor</div>

<div class="mentor-container">
    @foreach($mentors as $mentor)
        <div class="mentor-card">
            <img src="{{ asset('storage/' . $mentor->foto) }}" alt="Foto {{ $mentor->nama }}">
            <h3>{{ $mentor->nama }}</h3>
            <p>{{ $mentor->bidang }}</p>

            <div class="rating">
                @php $full = floor($mentor->rating); @endphp
                @for($i = 0; $i < $full; $i++)
                    ★
                @endfor
                @if($mentor->rating > $full)
                    ☆
                @endif
            </div>

            <a href="{{ route('mentor.show', $mentor->id) }}" class="btn">Lihat Profil</a>
            <a href="{{ route('mentoring.request', $mentor->id) }}" class="btn secondary">Ajukan Mentoring</a>
        </div>
    @endforeach
</div>
@endsection
