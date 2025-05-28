<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expandable Hamburger Menu</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #EFEFEF;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: white; 
      padding: 10px 20px;
      color: #0C6AC1;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .navbar-left img {
      width: 20px;
      height: auto;
      cursor: pointer;
    }

    .logo img{
        width:55px;
        height: auto;
    }

    .hamburger {
      display: flex;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
    }

    .hamburger div {
      width: 25px;
      height: 3px;
      background-color: #0C6AC1;
    }

    .menu {
        display: none;
        position: absolute;
        top: 60px; /* Biar di bawah navbar */
        right: 0;
        width: 250px;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: -2px 2px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px 0 0 10px;
        z-index: 1000;
        flex-direction: column;
        }


    .menu-button {
      background-color: #a3cef1;
      color: #274c77;
      font-weight: bold;
      border: none;
      margin: 8px 0;
      padding: 15px;
      border-radius: 10px;
      cursor: pointer;
      text-align: left;
      width: 100%;
    }

    .submenu {
      display: none;
      padding-left: 15px;
    }

    .menu-button.active + .submenu {
      display: flex;
      flex-direction: column;
    }

    .menu-logout {
      background-color: #c10c1b;
      color: #ffffff;
      font-weight: bold;
      border: none;
      margin: 8px 0;
      padding: 15px;
      border-radius: 10px;
      cursor: pointer;
      text-align: left;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="navbar-left">
    <div class="logo">
        <img src="{{ asset('build/assets/logo-skillbridge.png') }}" alt="Logo">
    </div>
    
    <a href="{{ route('home') }}"><img src="{{ asset('build/assets/home.png') }}" alt="Home"></a>

    @php
        $jumlahBelumDibaca = \App\Models\Notifikasi::where('user_id', Auth::id())->where('is_read', false)->count();
    @endphp

    <div style="position: relative;">
      <a href="{{ route('notifikasi.index') }}">
          <img src="{{ asset('build/assets/notif.png') }}" alt="notifikasi">
      </a>
      @if($jumlahBelumDibaca > 0)
          <span style="
              position: absolute;
              top: -5px;
              right: -5px;
              background-color: red;
              color: white;
              font-size: 10px;
              padding: 2px 6px;
              border-radius: 999px;
              font-weight: bold;
          ">{{ $jumlahBelumDibaca }}</span>
      @endif
  </div>

    

    {{-- Jika sudah login, tampilkan nama dan profil --}}
    @auth
    <a href="{{ route('profil') }}" style="display: flex; align-items: center; gap: 8px;">
        <img src="{{ asset('build/assets/manusia.png') }}" alt="Profil">
        <span style="color: #0C6AC1; font-weight: bold;">
            {{ Auth::user()->name ?? Auth::user()->username }}
        </span>
    </a>
    @endauth

    {{-- Jika belum login, tampilkan tombol login --}}
    @guest
    <a href="{{ route('login') }}" style="display: flex; align-items: center; gap: 8px;">
        <img src="{{ asset('build/assets/manusia.png') }}" alt="Login">
        <span style="color: #0C6AC1; font-weight: bold;">Login</span>
    </a>
    @endguest
  </div>

  {{-- ini bikin hamburgernya --}}
  <div class="hamburger" onclick="toggleMenu()"> 
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<div class="menu" id="menu">
  <button class="menu-button" onclick="toggleSubmenu(this)">Tes Kesiapan Karir</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('tests.index')}}'">Daftar Tes</button>
        <button class="menu-button" onclick="location.href='{{ route('riwayat-test')}}'">Riwayat Tes</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Mentoring</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('mentor.index')}}'">Daftar Mentor</button>
    <button class="menu-button" onclick="location.href='{{ route('jadwal.index')}}'">Jadwal Mentoring</button>
    <button class="menu-button" onclick="location.href='{{ route('review.index')}}'">Riwayat Mentoring</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Forum Komunitas</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('forum')}}'">Forum</button>
    <button class="menu-button" onclick="location.href='{{ route('forum.create')}}'">Buat Postingan</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Rekomendasi</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('rekom.lowongan')}}'">Rekomendasi Pekerjaan</button>
    <button class="menu-button" onclick="location.href='{{ route('lamaran.index')}}'">Riwayat Lowongan</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Portofolio</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('porto.edit')}}'">Edit Portofolio</button>
    <button class="menu-button" onclick="location.href='{{ route('porto.show')}}'">Portofolio Kamu</button>
  </div>

    {{-- Tombol logout jika sudah login --}}
  @auth
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="menu-logout">Logout</button>
  </form>
  @endauth
</div>

<script>
  function toggleMenu() {
    const menu = document.getElementById("menu");
    menu.style.display = menu.style.display === "flex" ? "none" : "flex";
  }

  function toggleSubmenu(button) {
    // Ambil semua tombol menu utama
    const allButtons = document.querySelectorAll('.menu-button');

    // Tutup semua submenu dan hilangkan class active
    allButtons.forEach(btn => {
        if (btn !== button) {
        btn.classList.remove("active");
        const submenu = btn.nextElementSibling;
        if (submenu && submenu.classList.contains("submenu")) {
            submenu.style.display = "none";
        }
        }
    });

    // Toggle submenu dari tombol yang diklik
    const submenu = button.nextElementSibling;
    if (submenu && submenu.classList.contains("submenu")) {
        const isVisible = submenu.style.display === "flex";
        submenu.style.display = isVisible ? "none" : "flex";
        button.classList.toggle("active", !isVisible);
    }
    }

</script>

</body>
</html>
