<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class PortofolioController extends Controller
{
    
    public function show(Portofolio $portofolio)
    {
        $porto = Portofolio::where('user_id', auth()->id())->first();

        return view('portofolio.portofolio', compact('porto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portofolio $portofolio)
    {
        $porto = Portofolio::where('user_id', auth()->id())->first();
        return view('portofolio.edit', compact('porto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request, Portofolio $porto)
    {
        $data = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'telepon' => 'required|string',
        'bidang' => 'required|string',
        'deskripsi' => 'nullable|string',
        'cv' => 'nullable|file|mimes:pdf|max:2048',
        'porto' => 'nullable|file|mimes:pdf|max:2048',
        'sertifikat' => 'nullable|file|mimes:pdf|max:2048',
        'linkedin' => 'nullable|url',
    ]);

    foreach (['cv', 'porto', 'sertifikat'] as $file) {
        if ($request->hasFile($file)) {
            $data[$file] = $request->file($file)->store("portofolio/$file", 'public');
        }
    }

    $porto = Portofolio::updateOrCreate(
        ['user_id' => auth()->id()],
        $data
    );

        Notifikasi::create([
            'user_id' => Auth::id(),
            'judul' => 'Portofolio Tersimpan',
            'pesan' => 'Portofolio kamu berhasil disimpan.',
        ]);

        return redirect('/portofolio')->with('success', 'Portofolio berhasil diperbarui!');
    }
    
}
