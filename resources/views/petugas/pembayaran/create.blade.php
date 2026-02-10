@extends('layout.petugas')

@section('title', 'Tambah Pembayaran')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-maroon">Tambah Pembayaran</h2>
</div>

<hr class="border-gray-300 mb-6">

<div class="flex justify-center">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-2xl">

        <!-- ERROR VALIDASI -->
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-5">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- CLIENT-SIDE ERROR DISPLAY -->
        <div id="clientError" class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-5 hidden">
            <ul class="list-disc ml-5">
                <li id="errorMessage"></li>
            </ul>
        </div>

        <form action="{{ route('petugas.pembayaran.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- SISWA -->
            <div>
                <label class="block text-sm font-semibold text-maroon mb-1">
                    Siswa <span class="text-red-500">*</span>
                </label>
                <select id="siswa_id" name="siswa_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}"
                                data-spp="{{ $s->spp_id }}">
                            {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas ?? '-' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- SPP -->
            <div>
                <label class="block text-sm font-semibold text-maroon mb-1">
                    SPP <span class="text-red-500">*</span>
                </label>
                <select id="spp_id" name="spp_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                    <option value="">-- Pilih SPP --</option>
                    @foreach($spp as $sp)
                        <option value="{{ $sp->id }}"
                                data-nominal="{{ $sp->nominal }}">
                            {{ $sp->tahun }} - {{ ucfirst($sp->kategori) }} - Rp {{ number_format($sp->nominal,0,',','.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- BULAN & TAHUN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-maroon mb-1">
                        Bulan Dibayar <span class="text-red-500">*</span>
                    </label>
                    <select name="bulan_dibayar" required
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}" {{ old('bulan_dibayar') == $bulan ? 'selected' : '' }}>
                                {{ $bulan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-maroon mb-1">
                        Tahun Dibayar <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tahun_dibayar" value="{{ old('tahun_dibayar') ?? date('Y') }}" required
                           placeholder="Contoh: 2025"
                           class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
                </div>
            </div>

            <!-- TANGGAL BAYAR -->
            <div>
                <label class="block text-sm font-semibold text-maroon mb-1">
                    Tanggal Bayar <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tgl_bayar" value="{{ old('tgl_bayar') ?? date('Y-m-d') }}" required
                       class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-gold">
            </div>

            <!-- ACTION -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('petugas.pembayaran.index') }}"
                   class="px-5 py-2 rounded-lg bg-gray-300 text-gray-700 hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2 rounded-lg bg-maroon text-gold font-semibold hover:bg-maroonLight transition">
                    Simpan Pembayaran
                </button>
            </div>

        </form>
    </div>
</div>

<!-- SCRIPT OTOMATIS PILIH SPP SESUAI SISWA + VALIDASI DUPLIKAT -->
<script>
    const siswaSelect = document.getElementById('siswa_id');
    const sppSelect = document.getElementById('spp_id');
    const bulanSelect = document.querySelector('select[name="bulan_dibayar"]');
    const tahunInput = document.querySelector('input[name="tahun_dibayar"]');
    const form = document.querySelector('form');
    const clientError = document.getElementById('clientError');
    const errorMessage = document.getElementById('errorMessage');

    // Otomatis pilih SPP sesuai siswa
    siswaSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const sppId = selectedOption.dataset.spp || '';

        if(sppId) {
            sppSelect.value = sppId;
        } else {
            sppSelect.value = '';
        }
    });

    // Validasi duplikat pembayaran saat submit
    form.addEventListener('submit', function(e) {
        const siswaId = siswaSelect.value;
        const bulan = bulanSelect.value;
        const tahun = tahunInput.value;

        if (!siswaId || !bulan || !tahun) {
            return; // Biarkan validasi HTML yang menangani field required
        }

        // Cek pembayaran duplikat via AJAX
        fetch(`/petugas/pembayaran/check-duplicate?siswa_id=${siswaId}&bulan=${bulan}&tahun=${tahun}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    e.preventDefault();
                    errorMessage.textContent = `Bulan ${bulan} tahun ${tahun} sudah dibayar untuk siswa ini.`;
                    clientError.classList.remove('hidden');
                    
                    // Scroll ke error
                    clientError.scrollIntoView({ behavior: 'smooth' });
                } else {
                    clientError.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error checking duplicate:', error);
                // Jika error, biarkan form submit
            });
    });

    // Sembunyikan error saat user mengubah input
    [siswaSelect, bulanSelect, tahunInput].forEach(element => {
        element.addEventListener('change', function() {
            clientError.classList.add('hidden');
        });
    });
</script>

@endsection
