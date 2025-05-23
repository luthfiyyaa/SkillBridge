<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\RiwayatMentoring;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
{
    // Ambil seluruh jadwal yang punya feedback
    $feedbacks = RiwayatMentoring::with('jadwal')->latest()->get();
    $jadwals = Jadwal::latest()->get();

    return view('mentoring.review', compact('feedbacks', 'jadwals'));
}

    public function store(Request $request)
{
    $request->validate([
    'jadwal_id' => 'required|exists:jadwals,id',
    'rating' => 'required|integer|min:1|max:5',
    'komentar' => 'nullable|string',
    ]);

    RiwayatMentoring::create([
        'jadwal_id' => $request->jadwal_id,
        'rating' => $request->rating,
        'komentar' => $request->komentar
    ]);

    return redirect()->route('review.index')->with('success', 'Umpan balik berhasil dikirim!');
}
}
