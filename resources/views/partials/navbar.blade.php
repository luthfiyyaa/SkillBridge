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

    .logo img {
      width: 55px;
      height: auto;
    }

    .navbar-left img.icon {
      width: 20px;
      height: auto;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .navbar-left img.icon:hover {
      transform: scale(1.1);
    }

    .profile-link {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #0C6AC1;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .profile-link:hover {
      color: #094a8a;
    }

    .notification-container {
      position: relative;
    }

    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: #e74c3c;
      color: white;
      font-size: 10px;
      padding: 2px 6px;
      border-radius: 10px;
      font-weight: bold;
      min-width: 16px;
      text-align: center;
    }

    .hamburger {
      display: flex;
      flex-direction: column;
      gap: 4px;
      cursor: pointer;
      padding: 8px;
      border: 2px solid transparent;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .hamburger:hover {
      border-color: #0C6AC1;
      background-color: rgba(12, 106, 193, 0.1);
    }

    .hamburger-line {
      width: 25px;
      height: 3px;
      background-color: #0C6AC1;
      transition: all 0.3s ease;
      border-radius: 2px;
    }

    .hamburger.active .hamburger-line:nth-child(1) {
      transform: rotate(45deg) translate(6px, 6px);
    }

    .hamburger.active .hamburger-line:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active .hamburger-line:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    .menu {
      position: fixed;
      top: 80px;
      right: 20px;
      width: 300px;
      background-color: #ffffff;
      padding: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
      border-radius: 16px;
      z-index: 1000;
      max-height: calc(100vh - 100px);
      overflow-y: auto;
      transform: translateX(100%);
      opacity: 0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .menu.show {
      transform: translateX(0);
      opacity: 1;
    }

    .menu-section {
      margin-bottom: 8px;
    }

    .menu-button {
      background: linear-gradient(135deg, #a3cef1, #8bbde8);
      color: #274c77;
      font-weight: 600;
      border: none;
      margin: 4px 0;
      padding: 16px;
      border-radius: 12px;
      cursor: pointer;
      text-align: left;
      width: 100%;
      font-size: 14px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .menu-button::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    .menu-button:hover::before {
      left: 100%;
    }

    .menu-button:hover {
      background: linear-gradient(135deg, #8bbde8, #6ba8dc);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(12, 106, 193, 0.3);
    }

    .menu-button.active {
      background: linear-gradient(135deg, #6ba8dc, #5a9bd4);
    }

    .submenu {
      max-height: 0;
      overflow: hidden;
      padding-left: 15px;
      transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .submenu.show {
      max-height: 300px;
    }

    .submenu .menu-button {
      background: linear-gradient(135deg, #d1e7f0, #c4dde9);
      margin: 6px 0;
      padding: 14px;
      font-size: 13px;
      font-weight: 500;
    }

    .submenu .menu-button:hover {
      background: linear-gradient(135deg, #b8dce8, #aad4e2);
      transform: translateX(4px);
    }

    .menu-logout {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: #ffffff;
      font-weight: 700;
      border: none;
      margin: 20px 0 5px 0;
      padding: 16px;
      border-radius: 12px;
      cursor: pointer;
      text-align: center;
      width: 100%;
      font-size: 14px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .menu-logout::before {
      content: '⚠️';
      margin-right: 8px;
    }

    .menu-logout:hover {
      background: linear-gradient(135deg, #c0392b, #a93226);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      backdrop-filter: blur(2px);
    }

    .overlay.show {
      opacity: 1;
      visibility: visible;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .navbar {
        padding: 10px 15px;
      }

      .navbar-left {
        gap: 20px;
      }

      .navbar-left img.icon {
        width: 18px;
      }

      .logo img {
        width: 45px;
      }

      .menu {
        right: 10px;
        width: calc(100vw - 20px);
        max-width: 320px;
      }


    }

    @media (max-width: 480px) {
      .navbar-left {
        gap: 15px;
      }

      .hamburger {
        padding: 6px;
      }

      .hamburger-line {
        width: 20px;
        height: 2px;
      }
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
  <div class="hamburger" id="hamburger" onclick="toggleMenu()"> 
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
  </div>
</div>

<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<div class="menu" id="menu">
  <button class="menu-button" onclick="toggleSubmenu('submenu1')">Tes Kesiapan Karir</button>
  <div class="submenu" id="submenu1">
    <button class="menu-button" onclick="location.href='{{ route('tests.index')}}'">Daftar Tes</button>
        <button class="menu-button" onclick="location.href='{{ route('riwayat-test')}}'">Riwayat Tes</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu('submenu2')">Mentoring</button>
  <div class="submenu" id="submenu2">
    <button class="menu-button" onclick="location.href='{{ route('mentor.index')}}'">Daftar Mentor</button>
    <button class="menu-button" onclick="location.href='{{ route('jadwal.index')}}'">Jadwal Mentoring</button>
    <button class="menu-button" onclick="location.href='{{ route('review.index')}}'">Riwayat Mentoring</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu('submenu3')">Forum Komunitas</button>
  <div class="submenu" id="submenu3">
    <button class="menu-button" onclick="location.href='{{ route('forum')}}'">Forum</button>
    <button class="menu-button" onclick="location.href='{{ route('forum.create')}}'">Buat Postingan</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu('submenu4')">Rekomendasi</button>
  <div class="submenu" id="submenu4">
    <button class="menu-button" onclick="location.href='{{ route('rekom.lowongan')}}'">Rekomendasi Pekerjaan</button>
    <button class="menu-button" onclick="location.href='{{ route('lamaran.index')}}'">Riwayat Lowongan</button>
  </div>

  <button class="menu-button" onclick="toggleSubmenu('submenu5')">Portofolio</button>
  <div class="submenu" id="submenu5">
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
  console.log("Script loaded"); // Debug log

  function toggleMenu() {
      console.log("toggleMenu called"); // Debug log
      
      const menu = document.getElementById("menu");
      const overlay = document.getElementById("overlay");
      const hamburger = document.getElementById("hamburger");
      
      if (!menu || !overlay) {
          console.error("Menu or overlay element not found!");
          return;
      }
      
      const isOpen = menu.classList.contains("show");
      
      if (isOpen) {
          closeMenu();
      } else {
          openMenu();
      }
  }

  function openMenu() {
      console.log("Opening menu"); // Debug log
      
      const menu = document.getElementById("menu");
      const overlay = document.getElementById("overlay");
      
      menu.classList.add("show");
      overlay.classList.add("show");
      document.body.style.overflow = "hidden"; // Prevent scroll
  }

  function closeMenu() {
      console.log("Closing menu"); // Debug log
      
      const menu = document.getElementById("menu");
      const overlay = document.getElementById("overlay");
      
      menu.classList.remove("show");
      overlay.classList.remove("show");
      document.body.style.overflow = "auto"; // Enable scroll
      
      // Close all submenus
      const submenus = document.querySelectorAll('.submenu');
      submenus.forEach(submenu => {
          submenu.classList.remove("show");
      });
  }

  function toggleSubmenu(submenuId) {
      console.log("toggleSubmenu called for:", submenuId); // Debug log
      
      const submenu = document.getElementById(submenuId);
      if (!submenu) {
          console.error("Submenu not found:", submenuId);
          return;
      }
      
      // Close other submenus
      const allSubmenus = document.querySelectorAll('.submenu');
      allSubmenus.forEach(sm => {
          if (sm.id !== submenuId) {
              sm.classList.remove("show");
          }
      });
      
      // Toggle current submenu
      submenu.classList.toggle("show");
  }

  function navigateTo(page) {
      console.log("Navigating to:", page); // Debug log
      
      // Close menu
      closeMenu();
      
      // Show alert for demo
      alert(`Navigasi ke: ${page}`);
      
      // Untuk implementasi real, ganti dengan:
      // window.location.href = "/path/to/" + page.toLowerCase().replace(" ", "-");
  }

  function logout() {
      console.log("Logout called"); // Debug log
      
      closeMenu();
      
      if (confirm("Apakah Anda yakin ingin logout?")) {
          alert("Logout berhasil!");
          // Untuk implementasi real:
          // window.location.href = "/login";
      }
  }

  // Event listeners
  document.addEventListener('DOMContentLoaded', function() {
      console.log("DOM loaded"); // Debug log
      
      // Test if hamburger exists
      const hamburger = document.getElementById('hamburger');
      if (hamburger) {
          console.log("Hamburger element found");
      } else {
          console.error("Hamburger element NOT found!");
      }
  });

  // Close menu when pressing Escape
  document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
          closeMenu();
      }
  });
</script>

</body>
</html>
