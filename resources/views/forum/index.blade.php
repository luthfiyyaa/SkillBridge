@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #E8EBF4, #ffffff);
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .forum-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 50px 20px;
        text-align: center;
    }

    .forum-title {
        font-size: 36px;
        font-weight: bold;
        color: #2A2E5B;
        text-shadow: 1px 1px 2px #aaa;
        margin-bottom: 30px;
    }

    .search-filter {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-filter input,
    .search-filter select {
        padding: 10px 20px;
        width: 250px;
        border-radius: 30px;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-post {
        background-color: #3751FE;
        color: white;
        padding: 10px 25px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        margin: 20px 0;
        transition: background-color 0.3s;
    }

    .btn-post:hover {
        background-color: #2a3fd0;
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .post-card {
        background-color: #D5E1FF;
        padding: 25px;
        border-radius: 25px;
        box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s;
    }

    .post-card:hover {
        transform: translateY(-3px);
    }

    .post-title {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .post-summary {
        font-size: 14px;
        color: #333;
        margin-bottom: 20px;
    }

    .post-date {
        font-size: 12px;
        color: #777;
        margin-bottom: 10px;
    }

    .icons {
        display: flex;
        justify-content: center;
        gap: 20px;
        color: #a1a1a1;
        font-size: 18px;
    }
</style>

<div class="forum-container">
    <h1 class="forum-title">Forum</h1>

    <a href="{{ route('forum.create') }}" class="btn-post">buat postingan</a>

    <div class="posts-grid">
        @foreach ($posts as $post)
            <a href="{{ route('forum.show', $post->id) }}" class="post-card">
                <div class="post-title">{{ $post->title }}</div>
                <div class="post-summary">{{ Str::limit($post->summary, 100) }}</div>
                <div class="post-date">{{ $post->created_at->format('d/m/y') }}</div>
                <div class="icons">
                    <i class="fa-regular fa-comment"></i>
                </div>
            </a>
        @endforeach
    </div>
</div>

<!-- Font Awesome (CDN) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
