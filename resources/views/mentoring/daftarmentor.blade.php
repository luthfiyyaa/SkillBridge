<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            align-items: center;
            padding: 40px;
        }

        .filter-section select,
        .filter-section input[type="text"],
        .filter-section button {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        .mentor-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
            background-color: #e6f0ff;
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
            background-color: #007bff;
            color: white;
            font-weight: bold;
            transition: background 0.3s;
        }

        .star {
            font-size: 1.5rem;
            color: #ccc;
        }

        .star.filled {
            color: #FFD700; /* Kuning emas */
        }

        .star.half {
            color: #FFD700;
            position: relative;
        }

        .star.half::after {
            content: '★';
            color: #ccc;
            position: absolute;
            left: 50%;
            width: 50%;
            overflow: hidden;
        }

        .actions {
        display: flex;
        gap: 10px;
        margin-top: 1rem;
        }

        .actions button {
        background-color: #425CB8;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        cursor: pointer;
        }

    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
        <div class="filter-section">
            <input type="text" placeholder="Cari Mentor">
            <select name="bidang">
                <option value="">Filter Bidang</option>
                <option value="UI/UX">UI/UX</option>
                <option value="Backend">Backend</option>
            </select>
            <select name="ketersediaan">
                <option value="">Filter Ketersediaan</option>
                <option value="tersedia">Tersedia</option>
                <option value="tidak">Tidak Tersedia</option>
            </select>
            <button>Terapkan</button>
        </div>

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
</body>
</html>