<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - SPPay</title>

    <!-- GOOGLE FONT: POPPINS -->
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
    <aside class="w-64 bg-sidebarBg text-white flex-shrink-0 min-h-screen">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-8"><span class="text-gold">SP</span>Pay</h1>

            <p class="mb-6">Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span></p>

            <nav class="flex flex-col gap-3">
                <a href="/petugas/transaksi" class="px-4 py-2 rounded hover:bg-maroon transition-colors">Entri Pembayaran</a>
                <a href="/petugas/history" class="px-4 py-2 rounded hover:bg-maroon transition-colors">History Pembayaran</a>
                <a href="/logout" class="px-4 py-2 mt-4 bg-maroon text-gold rounded hover:bg-maroonLight transition-colors">Logout</a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        <h2 class="text-3xl font-bold text-maroon mb-4">Dashboard Petugas</h2>
        <p class="text-gray-700 text-lg mb-6">Gunakan menu di sebelah kiri untuk mengelola pembayaran dan melihat history transaksi.</p>

        <!-- Bisa ditambahkan konten dashboard lainnya di sini -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold text-maroon mb-2">Total Transaksi Hari Ini</h3>
                <p class="text-gray-700">35 transaksi</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-xl font-semibold text-maroon mb-2">Transaksi Bulan Ini</h3>
                <p class="text-gray-700">420 transaksi</p>
            </div>
        </div>
    </main>

</body>
</html>
