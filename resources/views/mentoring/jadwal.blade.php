<style>

    #calendar {
        background: lightyellow;
        max-width: 600px;
        margin: 0 auto;
        padding: 10px;
        min-height: 500px; /* agar kalender pasti terlihat */
    }
    .sesi-wrapper table { 
        width: 100%; 
        border-collapse: collapse; 
    } 
    .sesi-wrapper table th, .sesi-wrapper table td { 
        padding: 10px; 
        border: 1px solid #ccc; 
    } 
    .btn-wrapper { 
        margin-top: 20px; 
        display: flex; 
        gap: 10px; 
    } 
    .btn { 
        padding: 8px 16px; 
        background: #425CB8; 
        color: #fff; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer;
    } 
    .text-red { 
        color: red; 
    }
</style>

@extends('layouts.app') 

{{-- @push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
@endpush

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: [
                    @foreach($jadwals as $jadwal)
                    {
                        title: '{{ $jadwal->topik }}',
                        start: '{{ \Carbon\Carbon::parse($jadwal->tanggal)->toDateString() }}',
                        color: '{{ $jadwal->status == "Dibatalkan" ? "#FF4D4D" : "#506CFF" }}',
                    },
                    @endforeach
                ]
            });

            calendar.render();
        }
    });
</script>
@endpush --}}

@section('content') 
<div class="container"> 
    <h1 class="title">Jadwal Mentoring</h1> 
        {{-- <div class="calendar">
            <div id='calendar'></div>
        </div> --}}
</div> 

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
                        @foreach($jadwals as $jadwal) 
                        <tr> 
                            <td><input type="radio" name="selected_jadwal" value="{{ $jadwal->id }}"></td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td> 
                            <td>{{ $jadwal->topik }}</td> 
                            <td class="{{ $jadwal->status == 'Dibatalkan' ? 'text-red' : '' }}">{{ $jadwal->status }}</td> 
                            <td>{{ $jadwal->kontak }}</td> 
                        </tr> 
                        @endforeach 
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
