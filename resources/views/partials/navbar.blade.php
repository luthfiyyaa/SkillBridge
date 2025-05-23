<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expandable Hamburger Menu</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f9ff;
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #ABC4FF; /* Warna biru tua */
      padding: 10px 20px;
      color: white;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .navbar-left img {
      width: 35px;
      height: auto;
      cursor: pointer;
    }

    .logo img{
        width:80px;
        height: auto;
    }

    .hamburger {
      display: flex;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
    }

    .hamburger div {
      width: 30px;
      height: 5px;
      background-color: #0C6AC1;
    }

    .menu {
        display: none;
        position: absolute;
        top: 60px; /* Biar di bawah navbar */
        right: 0;
        width: 250px;
        background-color: #e6f0ff;
        padding: 20px;
        box-shadow: -2px 2px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px 0 0 10px;
        z-index: 1000;
        flex-direction: column;
        }


    .menu-button {
      background-color: white;
      color: #0C6AC1;
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
  </style>
</head>
<body>

<div class="navbar">
  <div class="navbar-left">
    <div class="logo">
        <img src="{{ asset('build/assets/logo-skillbridge.png') }}" alt="Logo">
    </div>
    
    {{-- <a href="{{ route('home') }}"> nanti kalo udah ada route nya dibuka komen trs img dinaikkan --}}
        <img src="{{ asset('build/assets/home.png') }}" alt="Home"></a>
    {{-- <a href="{{ route('notifikasi') }}"> --}}
        <img src="{{ asset('build/assets/notif.png') }}" alt="notifikasi"></a>
    <a href="{{ route('profil') }}"><img src="{{ asset('build/assets/manusia.png') }}" alt="Profil"></a>
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
    <button class="menu-button" onclick="location.href='{{ route('tests.index')}}'">Kategori Tes</button>
    <button class="menu-button" onclick="location.href='{{ route('mentor.index')}}'">Rekomendasi Kursus</button>
    <button class="menu-button" onclick="location.href='{{ route('mentor.index')}}'">Hasil Tes</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Mentoring</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='{{ route('mentor.index')}}'">Daftar Mentor</button>
    <button class="menu-button" onclick="location.href='{{ route('jadwal.index')}}'">Jadwal Mentoring</button>
    <button class="menu-button" onclick="location.href='{{ route('review.index')}}'">Riwayat Mentoring</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Komunitas</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='komunitas.html'">Komunitas</button>
    <button class="menu-button" onclick="location.href='forum.html'">Forum</button>
    <button class="menu-button" onclick="location.href='buat-postingan.html'">Buat Postingan</button>
    <button class="menu-button" onclick="location.href='notifikasi.html'">Notifikasi</button>
    <button class="menu-button" onclick="location.href='moderasi.html'">Moderasi</button>
    <button class="menu-button" onclick="location.href='banding.html'">Banding</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Rekomendasi Pekerjaan</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='rekomendasi.html'">Rekomendasi</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu(this)">Portofolio</button>
  <div class="submenu">
    <button class="menu-button" onclick="location.href='portofolio.html'">Portofolio</button>
  </div>
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
