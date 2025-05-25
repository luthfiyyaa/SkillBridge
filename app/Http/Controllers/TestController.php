<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function showTestForm(Request $request)
    {
        $testId = $request->query('test_id');
        $questionNumber = $request->query('q', 1);

        $test = Test::findOrFail($testId);
        $questions = Question::where('test_id', $testId)->get();

        $currentQuestion = $questions->slice($questionNumber - 1, 1)->first();
        $totalQuestions = $questions->count();

        return view('test.soal-test', compact('test', 'currentQuestion', 'questionNumber', 'totalQuestions', 'testId'));
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_answer' => 'required|in:a,b,c,d',
            'test_id' => 'required|exists:tests,id',
        ]);

        UserAnswer::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'question_id' => $request->question_id,
            ],
            [
                'test_id' => $request->test_id,
                'selected_answer' => $request->selected_answer,
            ]
        );

        // Pagination
        $nextQuestion = $request->question_number + 1;
        if ($nextQuestion > $request->total_questions) {
            return redirect()->route('test.result', ['test_id' => $request->test_id]);
        }

        return redirect()->route('test.question', [
            'test_id' => $request->test_id,
            'q' => $nextQuestion
        ]);
    }

    public function showQuestion(Request $request)
    {
        $testId = $request->query('test_id');
        $questionNumber = (int) $request->query('number', 1);

        $test = Test::findOrFail($testId);
        $questions = $test->questions()->get();
        $totalQuestions = $questions->count();

        if ($questionNumber < 1 || $questionNumber > $totalQuestions) {
            return redirect()->back()->with('error', 'Nomor soal tidak valid.');
        }

        $currentQuestion = $questions[$questionNumber - 1];

        $existingAnswer = UserAnswer::where('user_id', auth()->id())
            ->where('question_id', $currentQuestion->id)
            ->first();

        $answeredQuestions = UserAnswer::where('user_id', auth()->id())
            ->where('test_id', $testId)
            ->pluck('question_id')
            ->toArray();

        return view('test.soal-test', compact(
            'test',
            'testId',
            'currentQuestion',
            'questionNumber',
            'totalQuestions',
            'existingAnswer',
            'answeredQuestions'
        ));
    }


    // app/Http/Controllers/TestController.php
    public function showResult()
    {
        // Ambil data hasil tes dari database atau session
        $user = auth()->user();

        $results = DB::table('user_answers')
            ->join('questions', 'user_answers.question_id', '=', 'questions.id')
            ->where('user_answers.user_id', $user->id)
            ->select('questions.question_text', 'user_answers.selected_answer')
            ->get();

        return view('test.hasil-test', compact('results'));
    }

    public function submitTest(Request $request)
    {
        $userId = auth()->id();
        $testId = $request->input('test_id');

        $answers = UserAnswer::where('user_id', $userId)
                    ->where('test_id', $testId)
                    ->get();

        $correct = 0;

        foreach ($answers as $answer) {
            $question = Question::find($answer->question_id);
            if (
                $question &&
                trim(strtolower($question->correct_answer)) === trim(strtolower($answer->selected_answer))) 
                {
                $correct++;
            }

        }

        $total = $answers->count();
        $score = $total > 0 ? round(($correct / $total) * 100) : 0;

        TestResult::create([
            'user_id' => $userId,
            'test_id' => $testId,
            'score' => $score,
        ]);

        return redirect()->route('test.result')->with('success', 'Tes selesai! Skor kamu: ' . $score);
    }

    public function history()
    {
        $results = TestResult::with('test')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view('test.riwayat-test', compact('results'));
    }


}
