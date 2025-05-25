@extends('layouts.app')

@section('title', 'Soal Tes')

<style>
    #soal-test-page {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9fbfc;
        padding: 30px;
        display: flex;
        gap: 40px;
    }

    #soal-test-page h1 {
        font-size: 32px;
        color: #1a237e;
        margin-bottom: 20px;
    }

    #soal-test-page #timer {
        font-size: 20px;
        color: red;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .question-section {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        max-width: 600px;
        flex: 1;
    }

    .question-section label {
        display: block;
        margin: 12px 0;
        font-size: 18px;
        cursor: pointer;
    }

    .question-section input[type="radio"] {
        margin-right: 10px;
    }

    .btn-primary {
        background-color: #1976d2;
        border: none;
        padding: 10px 25px;
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background-color: #1565c0;
    }

    .overview-section {
        min-width: 160px;
    }

    .overview-section h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #1a237e;
    }

    .overview-button {
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #e3f2fd;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-align: center;
        font-weight: bold;
        color: #0d47a1;
        text-decoration: none;
    }

    .overview-button.active {
        background-color: #90caf9;
        border: 2px solid #1565c0;
    }

    .overview-button:hover {
        background-color: #bbdefb;
    }
</style>

@section('content')
<div id="soal-test-page">
    {{-- Kiri: Soal --}}
    <div class="question-section">
        <h1>{{ $test->title }}</h1>
        <div id="timer"></div>

        <form method="POST" action="{{ route('test.save') }}">
            @csrf
            <input type="hidden" name="test_id" value="{{ $testId }}">
            <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
            <input type="hidden" name="question_number" value="{{ $questionNumber }}">
            <input type="hidden" name="total_questions" value="{{ $totalQuestions }}">

            <p><strong>{{ $questionNumber }}. {{ $currentQuestion->question_text }}</strong></p>

            @foreach(['a', 'b', 'c', 'd'] as $opt)
                <label>
                    <input type="radio" name="selected_answer" value="{{ $opt }}" required>
                    {{ $currentQuestion->{'option_' . $opt} }}
                </label>
            @endforeach

            <button type="submit" class="btn btn-primary">Jawab & Lanjut</button>
        </form>

        <div style="margin-top: 20px;">
            @if ($questionNumber > 1)
                <a href="{{ route('test.question', ['test_id' => $testId, 'number' => $questionNumber - 1]) }}" class="btn btn-secondary">Previous</a>
            @endif

            @if ($questionNumber < $totalQuestions)
                <a href="{{ route('test.question', ['test_id' => $testId, 'number' => $questionNumber + 1]) }}" class="btn btn-secondary">Next</a>
            @endif
        </div>

    </div>

    {{-- Kanan: Overview --}}
    <div class="overview-section">
        <h3>Soal</h3>
        @for ($i = 1; $i <= $totalQuestions; $i++)
            <a 
                href="{{ route('test.question', ['test_id' => $testId, 'number' => $i]) }}" 
                class="overview-button {{ $i == $questionNumber ? 'active' : '' }}"
            >
                Soal {{ $i }}
            </a>
        @endfor
    </div>
</div>

{{-- Timer --}}
<script>
    let seconds = 300; // 5 menit
    const timerEl = document.getElementById("timer");

    const timer = setInterval(() => {
        let min = Math.floor(seconds / 60);
        let sec = seconds % 60;
        timerEl.textContent = `Sisa waktu: ${min}:${sec < 10 ? '0' + sec : sec}`;
        if (--seconds < 0) {
            clearInterval(timer);
            alert("Waktu habis!");
            window.location.href = "{{ route('test.result', ['test_id' => $testId]) }}";
        }
    }, 1000);
</script>
@endsection
