@extends('layouts.app')

<style>
    #calendar {
        background: lightyellow;
        max-width: 600px;
        margin: 0 auto 30px auto;
        padding: 10px;
        min-height: 500px; /* agar kalender pasti terlihat */
    }
    .sesi-wrapper {
        max-width: 700px;
        margin: 0 auto 40px auto;
        padding: 50px 70px;
        background-color: #ffffff;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    .sesi-wrapper h3 {
        margin-bottom: 20px;
        color: #333;
    }
    .sesi-wrapper table {
        width: 100%;
        border-collapse: collapse;
    }
    .sesi-wrapper table th,
    .sesi-wrapper table td {
        padding: 12px 10px;
        border: 1px solid #ccc;
        text-align: left;
        vertical-align: middle;
    }
    .sesi-wrapper table th {
        background-color: #e3eefe;
        font-weight: 600;
        color: #425CB8;
    }
    .btn-wrapper {
        margin-top: 25px;
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    .btn {
        padding: 10px 22px;
        background: #6096ba;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #37617c;
    }
    .btn[type="button"] {
        background-color: #6c757d;
    }
    .btn[type="button"]:hover {
        background-color: #565e64;
    }
    .text-red {
        color: red;
        font-weight: 600;
    }
</style>

@section('content')
<div class="container">
    <h1 class="title" style="margin-bottom: 30px; color: #274c77; text-align: center;">Jadwal Mentoring</h1>

    {{-- Uncomment jika mau pakai kalender --}}
    {{-- 
    <div id="calendar"></div>
    --}}

    <div class="sesi-wrapper">
        <h3>Daftar Sesi</h3>

        <form id="jadwal-action-form" method="POST" action="{{ route('jadwal.action') }}">
            @csrf
            <input type="hidden" name="jadwal_id" id="jadwal_id_hidden">

            <table>
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Tanggal</th>
                        <th>Topik</th>
                        <th>Status</th>
                        <th>Kontak</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $jadwal)
                        <tr>
                            <td><input type="radio" name="selected_jadwal" value="{{ $jadwal->id }}"></td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                            <td>{{ $jadwal->topik }}</td>
                            <td class="{{ $jadwal->status == 'Dibatalkan' ? 'text-red' : '' }}">
                                {{ $jadwal->status }}
                            </td>
                            <td>
                                @if ($jadwal->mentor && $jadwal->mentor->kontak)
                                    <a href="https://wa.me/{{ $jadwal->mentor->kontak }}" target="_blank">
                                        {{ $jadwal->mentor->kontak }}
                                    </a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Belum ada jadwal.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="btn-wrapper">
                <button type="submit" name="action" value="selesai" class="btn">Selesaikan Sesi</button>
                <button type="submit" name="action" value="batal" class="btn">Batalkan Sesi</button>
                <button type="button" onclick="window.location.href='/review-mentoring'" class="btn">Review Mentoring</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('jadwal-action-form').addEventListener('submit', function(e) {
        const selected = document.querySelector('input[name="selected_jadwal"]:checked');
        if (!selected) {
            e.preventDefault();
            alert('Pilih salah satu sesi terlebih dahulu!');
            return;
        }
        document.getElementById('jadwal_id_hidden').value = selected.value;
    });
</script>

@endsection
