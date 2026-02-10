<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Petugas') - SPPay</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- WARNA MAROON-GOLD -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: '#5C0B1E',
                        maroonLight: '#7A0F2C',
                        gold: '#E6B800',
                        goldSoft: '#FFF9E6',
                        grayBg: '#FAF7F2',
                        sidebarBg: '#4A0818'
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="font-poppins bg-grayBg min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-sidebarBg text-white min-h-screen flex flex-col">
        <div class="p-6 flex flex-col flex-1">

            <!-- LOGO -->
            <h1 class="text-2xl font-bold mb-8">
                <span class="text-gold">SP</span>Pay
            </h1>

            <!-- USER INFO -->
            <div class="mb-6 text-sm">
                Login sebagai
                <div class="mt-1 font-semibold text-gold">
                    {{ session('nama') }}
                </div>
            </div>

            <!-- NAV -->
            <nav class="flex flex-col gap-2 text-sm">

                <a href="/petugas"
                   class="px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('petugas') ? 'bg-maroon text-gold' : '' }}">
                    Dashboard
                </a>

                <!-- GARIS -->
                <hr class="my-2 border-maroonLight/40">

                <a href="/petugas/pembayaran/create"
                   class="px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('petugas/pembayaran/create') ? 'bg-maroon text-gold' : '' }}">
                    + Tambah Pembayaran
                </a>

                <a href="/petugas/pembayaran"
                   class="px-4 py-2 rounded-lg hover:bg-maroon transition
                   {{ request()->is('petugas/pembayaran') ? 'bg-maroon text-gold' : '' }}">
                    History Pembayaran
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
