<?php

// app/Http/Controllers/DataDiriController.php
namespace App\Http\Controllers;
use App\Models\DataDiri;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;
use Illuminate\Http\Request;


class DataDiriController extends Controller
{
    public function showForm()
    {
        $existing = DataDiri::where('user_id', Auth::id())->first();
        if ($existing) {
            return redirect()->route('profil');
        }

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

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            if ($file->isValid()) {
                $path = $file->store('foto-profil', 'public');
            } else {
                return back()->withErrors(['foto' => 'File foto tidak valid']);
            }
        } else {
            $path = null;
        }


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
            'foto' => $path,
        ]);

        Notifikasi::create([
            'user_id' => Auth::id(),
            'judul' => 'Data Diri Tersimpan',
            'pesan' => 'Data diri kamu berhasil disimpan.',
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

    public function edit()
    {
        $profil = DataDiri::where('user_id', auth()->id())->firstOrFail();
        return view('dashboard.datadiri-edit', compact('profil'));
    }

    public function update(Request $request)
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
            'foto' => 'nullable|image|max:10240',
        ]);

        $profil = DataDiri::where('user_id', auth()->id())->firstOrFail();

        $data = [
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'institusi' => $request->institusi,
            'bidang_minat' => $request->bidang_minat,
        ];

       if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            if ($file->isValid()) {
                $path = $file->store('foto-profil', 'public');
            } else {
                return back()->withErrors(['foto' => 'File foto tidak valid']);
            }
        } else {
            $path = null;
        }


        $profil->update($data);

        Notifikasi::create([
            'user_id' => Auth::id(),
            'judul' => 'Data Diri Tersimpan',
            'pesan' => 'Data berhasil diperbarui!',
        ]);

        return redirect()->route('profil')->with('success', 'Data berhasil diperbarui!');
    }



}
