<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
    public function update(Request $request, Portofolio $portofolio)
    {
        $validated = $request->validate([
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

        $porto = Portofolio::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        // Simpan file jika ada
        foreach (['cv', 'porto', 'sertifikat'] as $file) {
            if ($request->hasFile($file)) {
                $porto->$file = $request->file($file)->store("portofolio/$file", 'public');
            }
        }

        $porto->save();

        return redirect('/portofolio')->with('success', 'Portofolio berhasil diperbarui!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portofolio $portofolio)
    {
        //
    }
}
