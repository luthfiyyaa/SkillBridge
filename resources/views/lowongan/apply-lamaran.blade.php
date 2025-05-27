@extends('layouts.app')

@section('content')
    <style>
        body { 
            background: #f0f4fa; 
            margin: 0; 
            padding: 20px; 
        }
        .container { 
            max-width: 800px; 
            margin: auto; 
            background: white; 
            border-radius: 10px; 
            padding: 30px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        h2 { 
            text-align: center; 
            color: #2b3a67; 
        }
        label { 
            display: block;
            margin-top: 15px; 
            font-weight: bold; 
        }
        input[type=text], input[type=email], input[type=number], textarea, select {
            width: 100%; 
            padding: 10px; 
            margin-top: 5px; 
            border: 1px solid #ccc; 
            border-radius: 8px;
        }
        textarea { 
            height: 120px; 
        }
        .btn {
            margin-top: 20px; 
            padding: 10px 20px; 
            background: #3f51b5; 
            color: white; 
            border: none;
            border-radius: 8px; 
            cursor: pointer; 
            float: right;
        }
        .btn:hover { 
            background: #303f9f; 
        }
    </style>

    <div class="container">
        <h2>Apply Lamaran</h2>

        <form action="{{ route('lamaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">

            <p><strong>Lamar - {{ $lowongan->title }}</strong><br>{{ $lowongan->perusahaan }}</p>

            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Nomor Telepon</label>
            <input type="text" name="telepon" required>

            <label>Pengalaman Kerja (Tahun)</label>
            <input type="number" name="pengalaman" required>

            <label>Mengapa Kami Harus Menerima Anda?</label>
            <textarea name="alasan" required></textarea>

            <label>Hubungkan dengan Portofolio</label><br>
            @if ($portofolio)
                <input type="hidden" name="file_portofolio" value="{{ $portofolio->file_path }}">
                <p>Portofolio ditemukan: <a href="{{ asset('storage/' . $portofolio->file_path) }}" target="_blank">{{ $portofolio->judul }}</a></p>
            @else
                <input type="file" name="file_portofolio">
            @endif

            <button type="submit" class="btn">Kirim Lamaran</button>
        </form>
    </div>
@endsection