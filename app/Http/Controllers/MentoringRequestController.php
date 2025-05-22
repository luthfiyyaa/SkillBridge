<?php

namespace App\Http\Controllers;

use App\Models\MentoringRequest;
use Illuminate\Http\Request;

class MentoringRequestController extends Controller
{
   public function create($id)
    {
        $mentor = Mentor::findOrFail($id);
        return view('mentoring.request', compact('mentor'));
    }

    public function store(Request $request, $id)
    {
        $mentor = Mentor::findOrFail($id);

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'nullable|string',
        ]);

        MentoringRequest::create([
            'mentor_id' => $mentor->id,
            'nama_pemohon' => $validated['nama_pemohon'],
            'email' => $validated['email'],
            'pesan' => $validated['pesan'],
        ]);

        return redirect()->route('mentoring.request', $mentor->id)->with('success', 'Pengajuan mentoring berhasil dikirim.');
    }
}