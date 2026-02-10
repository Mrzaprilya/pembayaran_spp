<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin') - SPPay</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<!-- Heroicons CDN -->
<script src="https://unpkg.com/heroicons@2.0.18/dist/heroicons.min.js"></script>

<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        maroon: '#5C0B1E',
        maroonDark: '#5C0D0D',
        maroonLight: '#7A0F2C',
        gold: '#E6B800',
        goldLight: '#FFD633',
        grayBg: '#FAF7F2',
        sidebarBg: '#4A0818',
        grayText: '#F3F4F6',
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      }
    }
  }
}
</script>
</head>

<body class="bg-grayBg font-poppins min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-sidebarBg text-white min-h-screen flex flex-col">

        <div class="p-6 flex-1">

            <!-- LOGO -->
            <h1 class="text-2xl font-bold mb-8">
                <span class="text-gold">SP</span>Pay
            </h1>

            <!-- USER -->
            <div class="text-sm mb-6">
                Halo,
                <div class="font-semibold text-gold mt-1">
                    {{ session('nama') }}
                </div>
                <div class="text-xs text-grayText mt-1">Administrator</div>
            </div>

            <!-- NAV -->
            <nav class="flex flex-col gap-2 text-sm">

                <a href="/admin"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h6v6H3V3zM15 3h6v6h-6V3zM3 15h6v6H3v-6zM15 15h6v6h-6v-6z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="/admin/pembayaran"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin/pembayaran*') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                    </svg>
                    Riwayat Pembayaran
                </a>

                <!-- GARIS -->
                <hr class="my-2 border-maroonLight/40">

                <a href="/admin/petugas"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin/petugas*') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.803 5.121 9 9 0 015.121 17.804zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Data Petugas
                </a>

                <a href="/admin/kelas"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin/kelas*') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/>
                    </svg>
                    Data Kelas
                </a>

                <a href="/admin/spp"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin/spp*') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM12 14c-4 0-8 2-8 4v2h16v-2c0-2-4-4-8-4z"/>
                    </svg>
                    Data SPP
                </a>

                <a href="/admin/siswa"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('admin/siswa*') ? 'bg-maroon text-gold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.803 5.121 9 9 0 015.121 17.804z"/>
                    </svg>
                    Data Siswa
                </a>

            </nav>
        </div>

        <!-- LOGOUT BAWAH -->
        <div class="p-6 border-t border-maroonLight/40">
            <a href="/logout"
               class="block text-center px-4 py-2 rounded-lg
                      bg-maroon text-gold font-semibold
                      hover:bg-maroonLight transition">
                Logout
            </a>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white/80 backdrop-blur rounded-2xl p-6 shadow">
                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
