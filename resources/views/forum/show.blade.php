@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Postingan Forum</title>
    <style>
        body {
            background: #f0f4ff;
            margin: 0;
            
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .judul {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2a3d7c;
            margin-top: 50px;
        }

        .post-box {
            background: #dbeafe;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .post-box h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .post-box p {
            font-size: 14px;
            margin-bottom: 10px;
            color: #333;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-top: 10px;
        }

        .icon-group span {
            margin-right: 15px;
            color: #555;
        }

        .flag-icon {
            font-size: 20px;
        }

        .komentar-section {
            background: #dbeafe;
            padding: 20px;
            border-radius: 20px;
            margin-top: 30px;
        }

        .komentar-section h4 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .komentar-item {
            background: #fff;
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
            resize: vertical;
        }

        .submit-btn {
            margin-top: 10px;
            background: #3b82f6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="judul">Postingan Forum</div>

        <div class="post-box">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            <p>{{ $post->created_at->format('d/m/y') }}</p>

            <div class="post-meta">
                    <span> <i class="fa-regular fa-comment"></i> {{ $komentar->count() }}</span>  
            </div>
        </div>

        <div class="komentar-section">
            <h4>Komentar</h4>

            @foreach($komentar as $k)
                <div class="komentar-item">{{ $k->isi }}</div>
            @endforeach

            <form action="{{ route('forum.kirimKomentar', $post->id) }}" method="POST">
                @csrf
                <textarea name="isi" rows="3" placeholder="Tulis komentar..."></textarea>
                <button type="submit" class="submit-btn">Kirim Komentar</button>
            </form>
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</html>
@endsection