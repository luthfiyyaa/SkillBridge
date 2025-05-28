@extends('layouts.app')

@section('content')
<style>
        body { 
            background: #efefef; 
        }
        .riw-container { 
            max-width: 900px; 
            margin: auto; 
            margin-top: 70px;
            background: white; 
            border-radius: 10px; 
            padding: 30px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
        }
        h2 { 
            text-align: center; 
            color: #274c77; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 10px; 
            text-align: center; 
        }
        th { 
            background-color: #dce3f0; 
        }
        .badge { 
            padding: 6px 10px; 
            border-radius: 8px; 
            color: white; 
            font-size: 14px; 
        }
        .Diterima { 
            background-color: #4caf50; 
        }
        .Proses { 
            background-color: #6096ba; 
        }
        .Ditolak { 
            background-color: #f44336; 
        }
        .btn-email { 
            background-color: #6096ba; 
            color: white; 
            border: none; 
            padding: 6px 12px; 
            border-radius: 8px; 
            cursor: pointer; 
        }
        .btn-email:hover { 
            background-color: #336180; 
        }
        
    </style>

    <div class="riw-container">
        <h2>Riwayat Lamaran Kerja Anda</h2>

        <table>
            <thead>
                <tr>
                    <th>Posisi</th>
                    <th>Perusahaan</th>
                    <th>Tanggal Lamar</th>
                    <th>Status</th>
                    <th>Hubungi Perusahaan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lamarans as $lamaran)
                    <tr>
                        <td>{{ $lamaran->lowongan->title }}</td>
                        <td>{{ $lamaran->lowongan->company }}</td>
                        <td>{{ \Carbon\Carbon::parse($lamaran->created_at)->translatedFormat('d F Y') }}</td>
                        <td><span class="badge {{ $lamaran->status }}">{{ $lamaran->status }}</span></td>
                        <td><a href="mailto:hr@{{ Str::slug($lamaran->lowongan->perusahaan) }}.com"><button class="btn-email">Kirim Email</button></a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada riwayat lamaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

@endsection