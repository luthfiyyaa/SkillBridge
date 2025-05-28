<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\RiwayatMentoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

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

    Notifikasi::create([
            'user_id' => Auth::id(),
            'judul' => 'Umpan Balik Tersimpan',
            'pesan' => 'Umpan balik berhasil dikirim.',
        ]);

    return redirect()->route('review.index')->with('success', 'Umpan balik berhasil dikirim!');
}
}
