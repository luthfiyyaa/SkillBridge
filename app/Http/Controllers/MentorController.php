<?php

namespace App\Http\Controllers;
use App\Models\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'bidang' => 'required|string',
            'ketersediaan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mentor_photos', 'public');
        }

        Mentor::create($validated);

        return redirect()->back()->with('success', 'Data mentor berhasil disimpan.');
    }

    public function index(Request $request)
    {
        $query = Mentor::query();

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        if ($request->filled('bidang')) {
            $query->where('bidang', $request->bidang);
        }

        if ($request->filled('ketersediaan')) {
            $query->where('ketersediaan', $request->ketersediaan);
        }

        $mentors = $query->get();

        return view('mentoring.daftarmentor', compact('mentors'));
    }

    public function show($id)
    {
        $mentor = Mentor::findOrFail($id);
        return view('mentoring.profil-mentor', compact('mentor'));
    }


}
