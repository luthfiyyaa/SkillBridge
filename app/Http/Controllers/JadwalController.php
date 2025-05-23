<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
public function index()
{
    $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();
        foreach ($jadwals as $jadwal) {
            $jadwal->tanggal = \Carbon\Carbon::parse($jadwal->tanggal)->toDateString();
        }
        return view('mentoring.jadwal', compact('jadwals'));
    }

    public function handleAction(Request $request)
    {
        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        if ($request->action === 'selesai') {
            $jadwal->status = 'Selesai';
        } elseif ($request->action === 'batal') {
            $jadwal->status = 'Dibatalkan';
        }

        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Status sesi diperbarui.');
    }

}
