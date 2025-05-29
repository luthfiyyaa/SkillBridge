<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Portofolio;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lamaran::with('lowongan')->where('user_id', Auth::id());

        // Filter berdasarkan status jika di-request
        if ($request->has('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        // Jumlah per halaman (default: 5)
        $perPage = $request->get('per_page', 5);

        $lamarans = $query->paginate($perPage);

        return view('lowongan.riwayat-lamaran', compact('lamarans'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lowongan_id)
    {
        $lowongan = Lowongan::findOrFail($lowongan_id);

        // Ambil portofolio milik user yang sedang login
        $portofolio = Portofolio::where('user_id', auth()->id())->latest()->first();

        return view('lowongan.apply-lamaran', compact('lowongan', 'portofolio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'telepon' => 'required',
        'pengalaman' => 'required|numeric',
        'alasan' => 'required',
        'lowongan_id' => 'required|exists:lowongans,id',
    ]);

    // Jika file portofolio tidak dikirim dari form, ambil dari database
    $filePath = $request->file_portofolio;

    if (!$filePath && $request->hasFile('file_portofolio')) {
        $filePath = $request->file('file_portofolio')->store('portofolio', 'public');
    }


    Lamaran::create([
        'user_id' => Auth::id(),
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'pengalaman' => $request->pengalaman,
        'alasan' => $request->alasan,
        'file_portofolio' => $filePath,
        'lowongan_id' => $request->lowongan_id,
        'status' => 'Proses'
    ]);

    Notifikasi::create([
        'user_id' => Auth::id(),
        'judul' => 'Lamaran Tersimpan',
        'pesan' => 'Lamaran berhasil dikirim.',
    ]);

    return redirect('/riwayat-lamaran')->with('success', 'Lamaran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lamaran $lamaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lamaran $lamaran)
    {
        //
    }
}
