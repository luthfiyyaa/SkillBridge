<?php

// app/Http/Controllers/DataDiriController.php
namespace App\Http\Controllers;
use App\Models\DataDiri;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    public function showForm()
    {
        return view('dashboard.datadiri');
    }

    public function submitForm(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required',
            'institusi' => 'required',
            'bidang_minat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-profil', 'public');
        }

        $data['user_id'] = auth()->id();

        DataDiri::create($data);

        return redirect()->route('profil')->with('success', 'Data berhasil disimpan!');
    }

    public function showProfile()
    {
        $data = DataDiri::where('user_id', auth()->id())->first();

        if (!$data) {
            return redirect()->route('datadiri.create')->with('warning', 'Silakan isi data diri terlebih dahulu.');
        }

        return view('dashboard.profile', compact('data'));
    }

}
