@extends('layouts.app')


@section('content')
    <style>
        body {
            font-family: sans-serif;
            background: #efefef;
            margin: 0;
            padding: 0;
        }

        .tcontainer {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            color: #274c77;
        }

        .question-box {
            margin: 20px 0;
        }

        .code {
            background: #0f172a;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-family: monospace;
            margin-top: 10px;
            white-space: pre-wrap;
        }

        .options input {
            margin-right: 10px;
        }

        .options label {
            display: block;
            margin: 8px 0;
            padding: 10px;
            background: #b8e3ff;
            border-radius: 8px;
            cursor: pointer;
        }

        .navigation {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        button {
            background-color: #6096ba;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #375f79;
            cursor: not-allowed;
        }
    </style>

    <div class="tcontainer">
        <h1>Tes Coding</h1>
        <p>Perhatikan kode berikut ini:</p>

        <div class="question-box">
            <form action="{{ route('tes.answer') }}" method="POST">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <input type="hidden" name="index" value="{{ $index }}">

                @if (Str::contains($question->question_text, 'cout') || Str::contains($question->question_text, 'console'))
                    <div class="code">
                        {{ $question->question_text }}
                    </div>
                @else
                    <p>{{ $question->question_text }}</p>
                @endif

                <div class="options">
                    <label><input type="radio" name="answer" value="a" required> {{ $question->option_a }}</label>
                    <label><input type="radio" name="answer" value="b"> {{ $question->option_b }}</label>
                    <label><input type="radio" name="answer" value="c"> {{ $question->option_c }}</label>
                    <label><input type="radio" name="answer" value="d"> {{ $question->option_d }}</label>
                </div>

                <div class="navigation">
                    <button type="submit" name="action" value="prev" {{ $index == 0 ? 'disabled' : '' }}>Previous</button>
                    <button type="submit" name="action" value="{{ $lastQuestion ? 'finish' : 'next' }}">
                        {{ $lastQuestion ? 'Finish' : 'Next' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
