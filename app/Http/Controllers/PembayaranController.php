<?php
namespace App\Http\Controllers;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kelas = $request->kelas;

        $query = Pembayaran::with(['siswa.kelas','spp']);

        // Filter by month
        if ($bulan) {
            $query->where('bulan_dibayar', $bulan);
        }

        // Filter by year
        if ($tahun) {
            $query->where('tahun_dibayar', $tahun);
        }

        // Filter by class
        if ($kelas) {
            $query->whereHas('siswa.kelas', function($q) use ($kelas) {
                $q->where('nama_kelas', $kelas);
            });
        }

        // Use pagination with 10 items per page, ordered by latest payment
        $data = $query->orderBy('tgl_bayar', 'desc')->paginate(10);

        // Get list of classes for filter dropdown
        $listKelas = \App\Models\Kelas::orderBy('nama_kelas')->pluck('nama_kelas');

        return view('petugas.pembayaran.index', compact('data', 'bulan', 'tahun', 'kelas', 'listKelas'));
    }

    // CREATE
    public function create()
    {
        $siswa = Siswa::with('kelas','spp')->get();
         $spp   = Spp::all(); // tambahkan ini supaya bisa dipakai di blade

    // kirim ke view
    return view('petugas.pembayaran.create', compact('siswa','spp'));

        // bulan dropdown
        $bulan = [
            'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
        ];

        return view('petugas.pembayaran.create', compact('siswa','bulan'));
    }

    // STORE
    public function store(Request $request)
{
    $request->validate([
        'siswa_id' => 'required|exists:siswa,id',
        'bulan_dibayar' => 'required',
        'tahun_dibayar' => 'required|digits:4',
        'tgl_bayar' => 'required|date'
    ]);

    // Cek apakah siswa sudah membayar untuk bulan dan tahun tersebut
    $existingPayment = Pembayaran::where('siswa_id', $request->siswa_id)
        ->where('bulan_dibayar', $request->bulan_dibayar)
        ->where('tahun_dibayar', $request->tahun_dibayar)
        ->first();

    if ($existingPayment) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['bulan_dibayar' => 'Bulan ' . $request->bulan_dibayar . ' tahun ' . $request->tahun_dibayar . ' sudah dibayar untuk siswa ini.']);
    }

    $siswa = Siswa::findOrFail($request->siswa_id);
    $spp = $siswa->spp; // ambil SPP sesuai siswa
    $petugasId = session('petugas_id'); // <-- sesuaikan dengan auth session

    if (!$petugasId) {
        return redirect()->route('petugas.pembayaran.create')
                         ->with('error', 'Petugas belum login!');
    }

    Pembayaran::create([
        'petugas_id' => $petugasId,
        'siswa_id' => $siswa->id,
        'spp_id' => $spp->id,
        'tgl_bayar' => $request->tgl_bayar,
        'bulan_dibayar' => $request->bulan_dibayar,
        'tahun_dibayar' => $request->tahun_dibayar,
        'jumlah_bayar' => $spp->nominal
    ]);

    return redirect()->route('petugas.pembayaran.index')
                     ->with('success','Pembayaran berhasil ditambahkan');
}

// CHECK DUPLICATE PAYMENT (AJAX)
public function checkDuplicate(Request $request)
{
    $exists = Pembayaran::where('siswa_id', $request->siswa_id)
        ->where('bulan_dibayar', $request->bulan)
        ->where('tahun_dibayar', $request->tahun)
        ->exists();

    return response()->json(['exists' => $exists]);
}
public function cetak($id)
{
    // Ambil pembayaran beserta relasi siswa, spp, dan petugas
    $pembayaran = Pembayaran::with(['siswa.kelas', 'spp', 'petugas'])
                             ->findOrFail($id);

    return view('petugas.pembayaran.cetak', compact('pembayaran'));
}
}
