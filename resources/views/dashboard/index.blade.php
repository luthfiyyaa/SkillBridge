<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<style>
    .hero {
        background: url('{{ asset('images/gambar.png') }}') no-repeat center center;
        background-size: cover;
        padding: 100px 20px;
        text-align: center;
        color: white;
        min-height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .hero h1 {
        font-size: 100px;
    }

    .hero-buttons .btn {
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 8px;
        background-color: #425CB8;
        color: white;
    }

    .scroll-target {
        margin-top: 40px;
        margin-bottom: 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 20px;
    }

    .features {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
        font-weight: 200;
        gap: 24px;
        max-width: 1500px;
    }

    .feature-box {
        background-color: #eef2ff;
        padding: 20px;
        border-radius: 16px;
        width: 240px;
        text-align: left;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .feature-box:hover {
        transform: translateY(-4px);
        background-color: #dce4ff;
    }

    .feature-box strong {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.1rem;
    }

    .feature-box strong::after {
        content: '▼';
        transition: transform 0.3s ease;
    }

    .feature-box.active strong::after {
        content: '▲';
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        padding: 16px;
        z-index: 99;
    }

    .feature-box.active .dropdown-content {
        display: block;
    }

    .dropdown-content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-content li {
        margin-bottom: 10px;
    }

    .dropdown-content a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .dropdown-content a:hover {
        color: #3b82f6;
    }

    section {
        padding: 60px 20px;
        text-align: center;
    }

    .section-light { background-color: #f5f8ff; }
    .section-white { background-color: #ffffff; }
    .section-blue { background-color: #f0f4ff; }

    .section-title {
        font-size: 28px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .section-content {
        max-width: 800px;
        margin: 0 auto;
        font-size: 16px;
    }

    .info-cards {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .info-card {
        flex: 1;
        min-width: 250px;
    }

    .testi-card {
        background: #eef2ff;
        padding: 20px;
        border-radius: 12px;
        width: 300px;
    }

    .stat-item {
        font-size: 36px;
        color: #3b82f6;
    }
</style>

<!-- HERO SECTION -->
<div class="hero">
    <h1>Selamat Datang!</h1>
    @auth
        <p>Selamat datang, {{ Auth::user()->name }}</p>
    @endauth
    <h2>Jembatan Antara Keterampilan dan Karir</h2>
    <div class="hero-buttons">
        <button onclick="window.scrollBy({ top: 500, behavior: 'smooth' });" class="btn btn-primary">
            Mulai eksplorasi
        </button>
        @guest
            <p>Silakan login terlebih dahulu.</p>
            <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
        @endguest
    </div>
</div>

<!-- TENTANG KAMI -->
<section class="section-light">
    <h2 class="section-title">Apa itu SkillBridge?</h2>
    <p class="section-content">
        SkillBridge adalah platform pengembangan karir yang menjembatani mahasiswa dengan mentor, tes kesiapan karir, 
        dan rekomendasi pekerjaan sesuai kompetensi. Kami hadir untuk mendukung mahasiswa dalam merancang masa depan yang lebih terarah.
    </p>
    <div class="info-cards">
        <div class="info-card">
            🎯 <strong>Tujuan</strong><br>Membantu mahasiswa merencanakan dan mempersiapkan karier impian mereka.
        </div>
        <div class="info-card">
            👥 <strong>Siapa yang menggunakan?</strong><br>Mahasiswa, mentor profesional, dan pengelola karir kampus.
        </div>
        <div class="info-card">
            💡 <strong>Kenapa mahasiswa harus pakai?</strong><br>Akses langsung ke bimbingan karir, fitur tes kesiapan, dan koneksi dunia kerja.
        </div>
    </div>
</section>

<!-- STATISTIK -->
<section class="section-blue">
    <h2 class="section-title">Statistik SkillBridge</h2>
    <div class="info-cards">
        <div>
            <div class="stat-item">1,200+</div>
            <p>Mahasiswa Terdaftar</p>
        </div>
        <div>
            <div class="stat-item">150+</div>
            <p>Mentor Profesional</p>
        </div>
        <div>
            <div class="stat-item">300+</div>
            <p>Rekomendasi Pekerjaan</p>
        </div>
    </div>
</section>

<!-- FITUR UNGGULAN -->
<div id="features" class="scroll-target">
    <h2 class="section-title">Program Unggulan</h2>
    <div class="features">
        @php
            $features = [
                'Tes Kesiapan Karir' => [
                    ['label' => 'Daftar Test', 'route' => 'tests.index'],
                    ['label' => 'Hasil Tes', 'route' => 'test.result'],
                    ['label' => 'Riwayat Tes', 'route' => 'test.history'],
                ],
                'Mentoring' => [
                    ['label' => 'Daftar Mentor', 'route' => 'mentor.index'],
                    ['label' => 'Jadwal Mentoring', 'route' => 'jadwal.index'],
                    ['label' => 'Riwayat Mentoring', 'route' => 'review.index'],
                ],
                'Forum Komunitas' => [
                    ['label' => 'Forum', 'route' => 'forum'],
                    ['label' => 'Buat Postingan', 'route' => 'forum.create'],
                ],
                'Rekomendasi Pekerjaan' => [],
                'Portofolio Digital' => [],
            ];
        @endphp

        @foreach($features as $title => $subItems)
            <div class="feature-box" onclick="toggleDropdown(this)">
                <strong>{{ $title }}</strong>
                @if(count($subItems) > 0)
                    <div class="dropdown-content">
                        <ul>
                            @foreach($subItems as $item)
                                <li><a href="{{ route($item['route']) }}">{{ $item['label'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

<!-- TESTIMONI -->
<section class="section-white">
    <h2 class="section-title">Testimoni Pengguna</h2>
    <div class="info-cards">
        <div class="testi-card">
            <p>“SkillBridge sangat membantu saya mengenal potensi karir pribadi. Mentornya keren dan komunikatif.”</p>
            <strong>- Anisa, Mahasiswa Psikologi</strong>
        </div>
        <div class="testi-card">
            <p>“Fitur tes kesiapan karirnya sangat akurat. Saya jadi tahu arah yang ingin saya ambil.”</p>
            <strong>- Budi, Mahasiswa Teknik</strong>
        </div>
        <div class="testi-card">
            <p>“Saya berhasil mendapat mentor dan lowongan kerja sesuai minat saya. Terima kasih SkillBridge!”</p>
            <strong>- Clara, Mahasiswa Ilmu Komunikasi</strong>
        </div>
    </div>
</section>

<script>
    function toggleDropdown(clickedBox) {
        document.querySelectorAll('.feature-box').forEach(box => {
            if (box !== clickedBox) {
                box.classList.remove('active');
            }
        });
        clickedBox.classList.toggle('active');
    }
</script>
@endsection
