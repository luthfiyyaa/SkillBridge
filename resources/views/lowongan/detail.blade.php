@extends('layouts.app')

@section('content')
    <style>
        body {
            background: #efefef;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
            /* background-color: #f4faff; */
            /* box-shadow: 0 4px 10px rgba(0,0,0,0.1); */
            border-radius: 16px;
            /* margin-top: 50px; */
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            color: #274c77;
            text-shadow: 2px 2px #ccdff6;
        }

        .job-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            margin-bottom: 8px;
            color: #333;
        }

        .info i {
            color: #6096ba;
        }

        .tags {
            display: flex;
            gap: 16px;
            margin: 20px 0;
        }

        .tag {
            background-color: #6096ba;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
        }

        h3 {
            margin-top: 30px;
            margin-bottom: 10px;
            color: #274c77;
        }

        ul {
            margin-top: 5px;
            padding-left: 20px;
        }

        .apply-btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #6096ba;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }

        .back {
            margin-bottom: 20px;
        }

        .back a {
            text-decoration: none;
            color: #6096ba;
            font-size: 14px;
        }

        /* Ikon dengan emoji untuk kesan visual ringan */
        .icon {
            font-size: 16px;
        }
    </style>

    <div class="container">
        <div class="header">
            <h1>Detail Lowongan</h1>
        </div>

        <div class="job-title">{{ $lowongan->title }}</div>
        <div class="company">{{ $lowongan->company }}</div>

        <div class="info"><span class="icon">📍</span>{{ $lowongan->location }}</div>
        <div class="info"><span class="icon">💰</span>{{ $lowongan->salary }}</div>

        <div class="tags">
            <div class="tag">Full Time</div>
            <div class="tag">Remote</div>
        </div>

        <h3>Deskripsi Pekerjaan</h3>
        <p>{!! nl2br(e($lowongan->deskripsi)) !!}</p>

        <h3>Kualifikasi</h3>
        <p>{!! nl2br(e($lowongan->kualifikasi)) !!}</p>

        <a class="apply-btn" href="{{ route('lamaran.create', ['id' => $lowongan->id]) }}">Lamar Sekarang</a>
    </div>


@endsection