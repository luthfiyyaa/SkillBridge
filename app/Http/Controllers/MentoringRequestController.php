<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Models\MentoringRequest;
use App\Models\Jadwal; // jika ada model jadwal
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class MentoringRequestController extends Controller
{
   public function create($id)
    {
        $mentor = Mentor::findOrFail($id);
        return view('mentoring.request', compact('mentor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:mentors,id',
            'nama_pemohon' => 'required|string|max:100',
            'email' => 'required|email',
            'pesan' => 'required|string|max:255',
            'tanggal' => 'required|date'
        ]);

        // Simpan ke tabel mentoring_requests
        MentoringRequest::create([
            'mentor_id' => $request->mentor_id,
            'nama_pemohon' => $request->nama_pemohon,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        // Simpan ke tabel jadwal
        Jadwal::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal, // Gunakan sekarang jika belum ada input tanggal
            'topik' => $request->pesan,
            'status' => 'menunggu',
            'mentor_id' => $request->mentor_id,
            'kontak' => 'contoh' 
        ]);

        Notifikasi::create([
            'user_id' => Auth::id(),
            'judul' => 'Request Mentoring',
            'pesan' => 'Permintaan sesi berhasil dikirim!',
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Permintaan berhasil dikirim!');
    }

}