@extends('layouts.app')

@section('title', 'Hasil Tes')

@section('content')
<style>
    #result-page {
        font-family: 'Poppins', sans-serif;
        background-color: #f3f6fb;
        padding: 30px;
        margin-top: 80px; /* beri jarak dari navbar */
    }

    #result-page h1 {
        font-size: 36px;
        color: #333;
        margin-bottom: 20px;
    }

    #result-page p {
        font-size: 20px;
        color: #444;
        margin-bottom: 30px;
    }

    #result-page strong {
        color: #2e7d32;
    }

    #result-page a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #6a1b9a;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    #result-page a:hover {
        background-color: #4a148c;
    }
</style>

<div id="result-page">
    <h1>Hasil Tes</h1>

    @php
        use App\Models\UserAnswer;
        use App\Models\Question;

        $answers = UserAnswer::where('user_id', auth()->id())
            ->where('test_id', request('test_id'))
            ->get();

        $score = 0;
        foreach ($answers as $ans) {
            if ($ans->selected_answer === $ans->question->correct_answer) {
                $score++;
            }
        }

        $total = $answers->count();
    @endphp

    <p>Jawaban Benar: <strong>{{ $score }}</strong> dari <strong>{{ $total }}</strong> soal</p>
    <a href="{{ route('tests.index') }}">← Kembali ke Kategori Tes</a>
</div>
@endsection
