<?php

// app/Http/Controllers/DataDiriController.php
namespace App\Http\Controllers;
use App\Models\DataDiri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    public function showForm()
    {
        return view('dashboard.datadiri');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
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

        // if ($request->hasFile('foto')) {
        //     ['foto'] = $request->file('foto')->store('foto-profil', 'public');
        // }

        DataDiri::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'institusi' => $request->institusi,
            'bidang_minat' => $request->bidang_minat,
            'foto' => $request->foto,
        ]);

        return redirect()->route('profil')->with('success', 'Data berhasil disimpan!');
    }

    public function showProfile()
    {
        $profil = DataDiri::where('user_id', auth()->id())->first();

        if (!$profil) {
            return redirect()->route('datadiri.create')->with('warning', 'Silakan isi data diri terlebih dahulu.');
        }

        return view('dashboard.profile', compact('profil'));
    }



}
