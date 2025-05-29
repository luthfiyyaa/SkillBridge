<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAnswer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class TestController extends Controller
{
    public function start()
    {
        session()->forget(['current_question', 'answers']); // reset sesi
        session(['current_question' => 0, 'answers' => []]);

        return redirect()->route('tes.show');
    }

    public function show()
    {
        $index = session('current_question', 0);
        $testId = 1;

        $questions = Question::where('test_id', $testId)->orderBy('id')->get();
        $total = $questions->count();

        // Cegah error jika index out of bound
        if ($index >= $total) {
            return redirect()->route('tes.submit');
        }

        $lastQuestion = $index == $total - 1;
        $question = $questions[$index];

        return view('test.soal-test', [
            'question' => $question,
            'index' => $index,
            'lastQuestion' => $lastQuestion,
        ]);
    }


    public function answer(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required|in:a,b,c,d',
            'index' => 'required|integer',
            'action' => 'required|string'
        ]);

        $answers = session('answers', []);
        $answers[$request->question_id] = $request->answer;
        session(['answers' => $answers]);

        $index = $request->index;

        if ($request->action === 'next') {
            $index++;
        } elseif ($request->action === 'prev') {
            $index--;
        } elseif ($request->action === 'finish') {
            return redirect()->route('tes.submit');
        }

        session(['current_question' => $index]);
        return redirect()->route('tes.show');
    }


    public function submit()
    {
        $user = Auth::user();
        $answers = session('answers', []);
        $correct = 0;

        if (empty($answers)) {
            session()->forget(['current_question', 'answers']);
            return redirect()->route('tes.show')->with('error', 'Tidak ada jawaban yang dikirim.');
        }

        foreach ($answers as $questionId => $selected) {
            $question = Question::find($questionId);
            if (!$question) continue;

            $isCorrect = $question->correct_answer === $selected;

            UserAnswer::create([
                'user_id' => $user->id,
                'test_id' => $question->test_id,
                'question_id' => $question->id,
                'selected_answer' => $selected,
                'is_correct' => $isCorrect,
            ]);

            if ($isCorrect) $correct++;
        }

        $firstQuestion = Question::find(array_key_first($answers));
        if (!$firstQuestion) {
            session()->forget(['current_question', 'answers']);
            return redirect()->route('tes.show')->with('error', 'Soal tidak ditemukan.');
        }

        $testId = $firstQuestion->test_id;
        $totalQuestions = Question::where('test_id', $testId)->count();
        $score = round(($correct / $totalQuestions) * 100, 2);

        TestResult::create([
            'user_id' => $user->id,
            'test_id' => $testId,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correct,
            'score' => $score,
        ]);

        Notifikasi::create([
            'user_id' => $user->id,
            'judul' => 'Tes Selesai.',
            'pesan' => 'Tes berhasil diselesaikan.',
        ]);

        // Penting: hapus semua session terkait
        session()->forget(['current_question', 'answers']);

        return redirect()->route('hasil-test', ['test_id' => $testId])
            ->with('success', 'Tes berhasil diselesaikan.');

    }


    public function hasil($testId)
    {
        $user = Auth::user();

        // Ambil result terbaru
        $result = TestResult::where('user_id', $user->id)
            ->where('test_id', $testId)
            ->latest('created_at') // ambil yang terbaru
            ->first();

        if (!$result) {
            return redirect()->route('tes.show')->with('error', 'Hasil tes tidak ditemukan.');
        }

        // Ambil semua jawaban user untuk test ini
        $answers = UserAnswer::with('question')
            ->where('user_id', $user->id)
            ->where('test_id', $testId)
            ->get();

        return view('test.hasil-test', [
            'result' => $result,
            'answers' => $answers,
        ]);
    }

    public function riwayat()
    {
        $user = Auth::user();

        $results = TestResult::with('test')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('test.riwayat-test', compact('results'));
    }
}
