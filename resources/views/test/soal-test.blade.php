@extends('layouts.app')

@section('title', 'Soal Tes')

<style>
    html, body {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    #soal-test-page {
        font-family: 'Poppins', sans-serif;
        background-color: #efefef;
        padding: 30px;
        display: flex;
        gap: 40px;
        min-width: 100vh; /* 🔧 Bikin penuh tinggi layar */
        box-sizing: border-box;
        justify-content: center;
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
        width: 100px;
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

    .nav-button {
        padding: 8px 16px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: background-color 0.2s;
    }

    .nav-button:hover {
        background-color: #e0e0e0;
    }

    .submit-button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit-button:hover {
        background-color: #218838;
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

            @php
                $options = [
                    'a' => $currentQuestion->option_a,
                    'b' => $currentQuestion->option_b,
                    'c' => $currentQuestion->option_c,
                    'd' => $currentQuestion->option_d,
                ];

                $existingAnswer = \App\Models\UserAnswer::where('user_id', auth()->id())
                    ->where('question_id', $currentQuestion->id)
                    ->first();

                $selected = $existingAnswer->selected_answer ?? null;
            @endphp

            {{-- Tampilkan semua opsi, dan hanya centang jika sudah pernah jawab --}}
            @foreach($options as $key => $value)
                @if ($value)
                    <label>
                        <input 
                            type="radio" 
                            name="selected_answer" 
                            value="{{ $key }}"
                            {{ $selected === $key ? 'checked' : '' }}
                            required
                        > {{ strtoupper($key) }}. {{ $value }}
                    </label>
                @endif
            @endforeach

            <button type="submit" class="btn-primary">Simpan Jawaban</button>
        </form>

        {{-- Navigasi soal --}}
        <div style="margin-top: 20px; display: flex; gap: 10px;"> 
            @if ($questionNumber > 1) 
                <a href="{{ route('test.question', ['test_id' => $testId, 'number' => $questionNumber - 1]) }}" class="nav-button">Previous</a> 
            @endif

            @if ($questionNumber < $totalQuestions)
                <a href="{{ route('test.question', ['test_id' => $testId, 'number' => $questionNumber + 1]) }}" class="nav-button">Next</a>
            @else
                <form method="POST" action="{{ route('test.submit') }}"> 
                    @csrf 
                    <input type="hidden" name="test_id" value="{{ $testId }}"> 
                    <button type="submit" class="btn-primary" style="background-color: #dc3545;">Finish</button> 
                </form>
            @endif
        </div>
    </div>

    {{-- Kanan: Overview --}}
    <div class="overview-section">
        <h3>Soal</h3>
        @for ($i = 1; $i <= $totalQuestions; $i++)
            @php
                $questionId = $test->questions[$i - 1]->id;
                $isAnswered = in_array($questionId, $answeredQuestions ?? []);
            @endphp
            <a 
                href="{{ route('test.question', ['test_id' => $testId, 'number' => $i]) }}" 
                class="overview-button {{ $i == $questionNumber ? 'active' : '' }} {{ $isAnswered ? 'bg-success text-white' : '' }}"
            >
                Soal {{ $i }}
            </a>
        @endfor
    </div>
</div>

{{-- Timer Global --}}
<script>
    // 🔧 Simpan waktu di sessionStorage agar tetap konsisten di tiap soal
    const totalDuration = 20 * 60; // 5 menit
    const timerEl = document.getElementById("timer");

    if (!sessionStorage.getItem("remainingTime")) {
        sessionStorage.setItem("remainingTime", totalDuration);
    }

    let seconds = parseInt(sessionStorage.getItem("remainingTime"));

    const timer = setInterval(() => {
        let min = Math.floor(seconds / 60);
        let sec = seconds % 60;
        timerEl.textContent = `Sisa waktu: ${min}:${sec < 10 ? '0' + sec : sec}`;
        
        seconds--;
        sessionStorage.setItem("remainingTime", seconds);

        if (seconds < 0) {
            clearInterval(timer);
            sessionStorage.removeItem("remainingTime");
            alert("Waktu habis!");
            window.location.href = "{{ route('test.result', ['test_id' => $testId]) }}";
        }
    }, 1000);
</script>
@endsection
