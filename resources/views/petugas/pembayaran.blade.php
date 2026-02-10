<form action="/petugas/pembayaran" method="POST">
@csrf

<select name="siswa_id" required>
    <option value="">Pilih Siswa</option>
    @foreach($siswa as $s)
        <option value="{{ $s->id }}">
            {{ $s->nis }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})
        </option>
    @endforeach
</select>

<select name="spp_id" required>
    <option value="">Pilih SPP</option>
    @foreach($spp as $s)
        <option value="{{ $s->id }}">
            {{ $s->tahun }} - {{ $s->nominal }}
        </option>
    @endforeach
</select>

<input type="text" name="bulan_dibayar" placeholder="Bulan (contoh: Januari)">
<input type="text" name="tahun_dibayar" placeholder="Tahun (contoh: 2025)">
<input type="number" name="jumlah_bayar">

<button type="submit">Simpan</button>
</form>
