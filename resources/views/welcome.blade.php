<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SPPay - Sistem Pembayaran SPP</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        maroonDark: '#4B0000',
        gold: '#FFD700',
        cyanSoft: '#22D3EE',
        grayText: '#D1D5DB'
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif']
      },
      keyframes: {
        fadeIn: { '0%': { opacity: 0 }, '100%': { opacity: 1 } },
        slideUp: { '0%': { opacity: 0, transform: 'translateY(20px)' }, '100%': { opacity: 1, transform: 'translateY(0)' } },
        rightToLeft: { '0%': { opacity: 0, transform: 'translateX(50px)' }, '100%': { opacity: 1, transform: 'translateX(0)' } }
      },
      animation: {
        fadeIn: 'fadeIn 1.5s ease-in-out',
        slideUp: 'slideUp 1s ease-out',
        rightToLeft: 'rightToLeft 1s ease-out'
      }
    }
  }
}
</script>
</head>
<body class="font-poppins bg-gray-50 text-gray-900">

<!-- NAVBAR -->
<nav id="navbar" class="fixed w-full top-0 left-0 z-50 bg-white/0 backdrop-blur-md transition-all duration-500 shadow-md">
  <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <h1 id="logo" class="text-2xl font-bold text-gold animate-rightToLeft">SP<span class="text-maroonDark">Pay</span></h1>
    <ul class="hidden md:flex gap-6 text-lg">
      <li>
        <a href="#features" 
           class="text-gold hover:text-gray-400 focus:text-gray-400 transition">
          Fitur
        </a>
      </li>
      <li>
        <a href="#stats" 
           class="text-gold hover:text-gray-400 focus:text-gray-400 transition">
          Statistik
        </a>
      </li>
      <li>
        <a href="#faq" 
           class="text-gold hover:text-gray-400 focus:text-gray-400 transition">
          FAQ
        </a>
      </li>
      <li>
        <a href="#contact" 
           class="text-gold hover:text-gray-400 focus:text-gray-400 transition">
          Kontak
        </a>
      </li>
    </ul>
  </div>
</nav>


<!-- HERO -->
<section id="home" class="relative h-screen flex items-center">
  <!-- Background -->
  <img src="/images/sekolah.png" alt="Sekolah" 
       class="absolute inset-0 w-full h-full object-cover filter blur-[2px] brightness-90">

  <!-- Content -->
  <div class="relative max-w-5xl px-6 md:px-12">
    <h1 class="text-6xl md:text-7xl font-extrabold text-gold animate-fadeIn mb-6 drop-shadow-2xl">
      SP<span class="text-maroonDark">Pay</span>
    </h1>
    <p class="text-gray-100 text-xl md:text-2xl mb-8 max-w-lg animate-fadeIn drop-shadow-lg">
      Modernisasi pembayaran SPP sekolah Anda, mudah, cepat, dan aman.
    </p>
    <a href="/login"
   class="inline-block px-8 py-4 rounded-lg font-semibold text-gold bg-white/20 backdrop-blur-md border border-gold shadow-lg hover:bg-gold hover:text-maroonDark transition-all duration-300 animate-fadeIn">
  Login Sekarang
</a>
  </div>
</section>


<!-- FEATURES -->
<section id="features" class="py-16 bg-white">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h2 class="text-3xl md:text-4xl font-bold text-maroonDark mb-4">Fitur SPPay</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">Fitur unggulan untuk mengelola pembayaran SPP, laporan, dan data siswa dengan aman dan cepat.</p>
  </div>
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-maroonDark/10 p-6 rounded-xl shadow-md transition-transform transform hover:scale-105 animate-slideUp">
      <h3 class="font-bold text-maroonDark mb-2">Bayar SPP</h3>
      <p class="text-gray-700">Siswa dapat membayar SPP langsung melalui petugas di ruang tata usaha.</p>
    </div>
    <div class="bg-maroonDark/10 p-6 rounded-xl shadow-md transition-transform transform hover:scale-105 animate-slideUp delay-100">
      <h3 class="font-bold text-maroonDark mb-2">History Pembayaran</h3>
      <p class="text-gray-700">Cek riwayat pembayaran lengkap kapan saja.</p>
    </div>
    <div class="bg-maroonDark/10 p-6 rounded-xl shadow-md transition-transform transform hover:scale-105 animate-slideUp delay-200">
      <h3 class="font-bold text-maroonDark mb-2">Laporan Admin</h3>
      <p class="text-gray-700">Admin dapat mencetak laporan bulanan dan tahunan dengan mudah.</p>
    </div>
  </div>
</section>

<!-- STATS -->
<section id="stats" class="py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto text-center mb-10">
    <h2 class="text-3xl md:text-4xl font-bold text-maroonDark">Statistik</h2>
  </div>
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
    <div class="bg-maroonDark text-gold p-6 rounded-xl shadow-md hover:shadow-maroonDark transition transform animate-slideUp">
      <h3 class="text-3xl font-bold" id="students">0</h3>
      <p class="mt-2">Siswa Terdaftar</p>
    </div>
    <div class="bg-maroonDark text-gold p-6 rounded-xl shadow-md hover:shadow-maroonDark transition transform animate-slideUp delay-100">
      <h3 class="text-3xl font-bold" id="transactions">0</h3>
      <p class="mt-2">Transaksi Berhasil</p>
    </div>
    <div class="bg-maroonDark text-gold p-6 rounded-xl shadow-md hover:shadow-maroonDark transition transform animate-slideUp delay-200">
      <h3 class="text-3xl font-bold" id="admins">0</h3>
      <p class="mt-2">Admin & Petugas</p>
    </div>
    <div class="bg-maroonDark text-gold p-6 rounded-xl shadow-md hover:shadow-maroonDark transition transform animate-slideUp delay-300">
      <h3 class="text-3xl font-bold" id="revenue">0</h3>
      <p class="mt-2">Total Pendapatan</p>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-16 bg-white">
  <div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-maroonDark mb-6 text-center">FAQ</h2>
    <div class="space-y-4">
      <div class="border rounded-lg overflow-hidden">
        <button class="w-full flex justify-between items-center px-6 py-4 font-semibold bg-maroonDark/10 hover:bg-maroonDark/20 faq-toggle">
          Bagaimana cara membayar SPP?
          <span class="transform transition-transform duration-300 rotate-0">&#8250;</span>
        </button>
        <div class="px-6 py-4 hidden faq-content text-gray-700">
          Pergi ke petugas di ruang tata usaha, kemudian konfirmasi nama dan kelas anda.
        </div>
      </div>
      <div class="border rounded-lg overflow-hidden">
        <button class="w-full flex justify-between items-center px-6 py-4 font-semibold bg-maroonDark/10 hover:bg-maroonDark/20 faq-toggle">
          Apakah pembayaran aman?
          <span class="transform transition-transform duration-300 rotate-0">&#8250;</span>
        </button>
        <div class="px-6 py-4 hidden faq-content text-gray-700">
          Semua pembayaran menggunakan sistem terenkripsi dan terhubung dengan bank, sehingga aman dan terpercaya.
        </div>
      </div>
      <div class="border rounded-lg overflow-hidden">
        <button class="w-full flex justify-between items-center px-6 py-4 font-semibold bg-maroonDark/10 hover:bg-maroonDark/20 faq-toggle">
          Bagaimana melihat laporan pembayaran?
          <span class="transform transition-transform duration-300 rotate-0">&#8250;</span>
        </button>
        <div class="px-6 py-4 hidden faq-content text-gray-700">
          Login dengan nama lengkap dan NISN anda, maka web akan otomatis memberi laporan pembayaran anda.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="py-20 bg-gradient-to-r from-maroonDark/10 to-gold/10 text-center">
  <div class="max-w-3xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold text-maroonDark mb-8 drop-shadow-lg">Kontak Kami</h2>
    <div class="flex flex-col md:flex-row justify-center gap-12 mb-8">
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-maroonDark" fill="currentColor" viewBox="0 0 24 24">
          <path d="M2.01 6.51l9.99 6.99 9.99-6.99-9.99-6.99-9.99 6.99zM0 8.51v11h24v-11l-12 8.5-12-8.5z"/>
        </svg>
        <p class="text-gray-700 text-lg">admin@sppay.com</p>
      </div>
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-maroonDark" fill="currentColor" viewBox="0 0 24 24">
          <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.21 11.36 11.36 0 003.55.57 1 1 0 011 1v3.5a1 1 0 01-1 1A16 16 0 013 5a1 1 0 011-1h3.5a1 1 0 011 1c0 1.22.2 2.42.57 3.55a1 1 0 01-.21 1.11l-2.24 2.13z"/>
        </svg>
        <p class="text-gray-700 text-lg">+62 812 3456 7890</p>
      </div>
    </div>
    <a href="/login"
       class="inline-block px-10 py-4 rounded-xl font-semibold text-gold bg-white/20 backdrop-blur-md border border-gold shadow-lg hover:bg-gold hover:text-maroonDark transition-all duration-300">
      Login Sekarang
    </a>
  </div>
</section>

<!-- FOOTER -->
<footer class="bg-maroonDark text-center text-gray-100 py-6">
  <p class="text-sm">&copy; 2026 SPPay. All Rights Reserved.</p>
</footer>

<!-- SCRIPTS -->
<script>
// Navbar dinamis
window.addEventListener('scroll', () => {
  const navbar = document.getElementById('navbar');
  if(window.scrollY > 50){
    navbar.classList.remove('bg-white/0');
    navbar.classList.add('bg-white/90');
  } else {
    navbar.classList.remove('bg-white/90');
    navbar.classList.add('bg-white/0');
  }
});

// Statistik animasi hitung lebih cepat
function animateCount(id, target, duration) {
  const el = document.getElementById(id);
  let start = 0;
  let stepTime = Math.max(Math.floor(duration / target), 10); // lebih cepat
  const timer = setInterval(() => {
    start += 1;
    el.textContent = start.toLocaleString();
    if(start >= target) clearInterval(timer);
  }, stepTime);
}

// Panggil animasi dengan target
animateCount('students', 1200, 1000);      // 1 detik
animateCount('transactions', 1500, 1000);  // 1 detik
animateCount('admins', 20, 800);           // 0.8 detik
animateCount('revenue', 1200000, 1200);    // 1.2 detik

// FAQ dropdown dengan panah berputar
document.querySelectorAll('.faq-toggle').forEach(btn => {
  btn.addEventListener('click', () => {
    const content = btn.nextElementSibling;
    const arrow = btn.querySelector('span');
    content.classList.toggle('hidden');
    arrow.classList.toggle('rotate-90');
  });
});
</script>

</body>
</html>
