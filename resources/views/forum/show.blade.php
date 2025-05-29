@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Postingan Forum</title>
    <style>
        body {
            background: #efefef;
            margin: 0;
            
        }

        .container {
            width: 700px;
            margin: 0 auto;
        }

        .judul {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #274c77;
            margin-top: 50px;
        }

        .post-box {
            background: #ffffff;
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
            background: #ffffff;
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
            
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .komentar-isi {
            flex: 1;
            margin-right: 10px;
        }

        .komentar-tanggal {
            font-size: 0.875rem;
            color: #888;
            white-space: nowrap;
        }


        textarea {
            width: 630px;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
            resize: vertical;
        }

        .submit-btn {
            margin-top: 10px;
            background: #6096ba;
            color: white;
            padding: 10px 20px;
            border: #6096ba;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #234c67;
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

            <form action="{{ route('forum.kirimKomentar', $post->id) }}" method="POST">
                @csrf
                <textarea name="isi" rows="3" placeholder="Tulis komentar..."></textarea>
                <button type="submit" class="submit-btn">Kirim Komentar</button>
            </form>
        </div>

        <div class="komentar-section">
            @if ($komentar->isEmpty())
                <p style="color: #888;">Belum ada komentar.</p>
            @else
                @foreach($komentar as $k)
                    <div class="komentar-item">
                        <div class="komentar-isi">
                            <strong>{{ $k->user->name ?? 'Anonim' }}</strong><br>
                            {{ $k->isi }}
                        </div>
                        <span class="komentar-tanggal">{{ $k->created_at->format('d/m/y') }}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</html>
@endsection