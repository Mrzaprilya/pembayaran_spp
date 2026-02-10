<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    // INDEX
    public function index()
{
    $rawData = Spp::orderBy('tahun', 'desc')->get();

    $data = [];
    foreach ($rawData as $item) {
        $tahun = $item->tahun;
        // Gunakan strtolower agar 'Normal' atau 'NORMAL' tetap terbaca 'normal'
        $kat = strtolower($item->kategori);

        $data[$tahun][$kat] = $item->nominal;
        $data[$tahun]['ids'][$kat] = $item->id;
    }

    return view('admin.spp.index', compact('data'));
}

    // CREATE
    public function create()
    {
        return view('admin.spp.create');
    }

    // STORE
    public function store(Request $request)
    {
        // Cek apakah tahun sudah ada
        $cek = Spp::where('tahun', $request->tahun)->exists();
        if ($cek) {
            return back()->with('error','SPP untuk tahun ini sudah ada!');
        }

        $request->validate([
            'tahun'  => 'required|digits:4',
            'normal' => 'required|numeric',
            'kip'    => 'required|numeric',
            'yatim'  => 'required|numeric',
        ]);

        $data = [
            'normal' => $request->normal,
            'kip'    => $request->kip,
            'yatim'  => $request->yatim,
        ];

        foreach ($data as $kategori => $nominal) {
            Spp::create([
                'tahun'    => $request->tahun,
                'kategori' => $kategori,
                'nominal'  => $nominal,
            ]);
        }

        return redirect()->route('spp.index')->with('success','SPP berhasil ditambahkan');
    }

    // EDIT per TAHUN
    public function edit($tahun)
{
    $raw = Spp::where('tahun', $tahun)->get();

    $data = [];

    foreach ($raw as $item) {
        $key = strtolower($item->kategori); // normalisasi

        if (str_contains($key, 'normal')) {
            $data['normal'] = [
                'id' => $item->id,
                'nominal' => $item->nominal
            ];
        }

        if (str_contains($key, 'kip')) {
            $data['kip'] = [
                'id' => $item->id,
                'nominal' => $item->nominal
            ];
        }

        if (str_contains($key, 'yatim')) {
            $data['yatim'] = [
                'id' => $item->id,
                'nominal' => $item->nominal
            ];
        }
    }

    return view('admin.spp.edit', compact('data', 'tahun'));
}

    // UPDATE
    public function update(Request $request, $tahun)
{
    $request->validate([
        'tahun'  => 'required|digits:4',
        'normal' => 'required|numeric',
        'kip'    => 'required|numeric',
        'yatim'  => 'required|numeric',
    ]);

    // Cek apakah ada pembayaran yang sudah menggunakan SPP tahun ini
    $existingPayments = \App\Models\Pembayaran::whereHas('spp', function($query) use ($tahun) {
        $query->where('tahun', $tahun);
    })->exists();

    $data = Spp::where('tahun', $tahun)->get();

    if ($existingPayments) {
        // Jika sudah ada pembayaran, nonaktifkan SPP lama dan buat SPP baru
        // Nonaktifkan SPP lama
        foreach ($data as $item) {
            $item->is_active = false;
            $item->save();
        }

        // Buat SPP baru dengan tanggal berlaku besok
        $newData = [
            'normal' => $request->normal,
            'kip'    => $request->kip,
            'yatim'  => $request->yatim,
        ];

        $tanggalBerlaku = now()->addDay()->toDateString(); // Berlaku besok

        foreach ($newData as $kategori => $nominal) {
            // Cek apakah sudah ada SPP baru untuk kategori ini
            $existingNewSpp = Spp::where('tahun', $tahun)
                                ->where('kategori', $kategori)
                                ->where('is_active', true)
                                ->where('tanggal_berlaku', '>', now())
                                ->first();
            
            if (!$existingNewSpp) {
                Spp::create([
                    'tahun'          => $tahun,
                    'kategori'       => $kategori,
                    'nominal'        => $nominal,
                    'tanggal_berlaku'=> $tanggalBerlaku,
                    'is_active'      => true,
                ]);
            } else {
                $existingNewSpp->nominal = $nominal;
                $existingNewSpp->save();
            }
        }

        return redirect()
            ->route('spp.index')
            ->with('success','SPP berhasil diperbarui. Perubahan berlaku untuk pembayaran mulai ' . $tanggalBerlaku);
    } else {
        // Jika belum ada pembayaran, update langsung semua data SPP
        foreach ($data as $item) {
            // update tahun
            $item->tahun = $request->tahun;

            // update nominal sesuai kategori
            if (strtolower($item->kategori) === 'normal') {
                $item->nominal = $request->normal;
            }

            if (strtolower($item->kategori) === 'kip') {
                $item->nominal = $request->kip;
            }

            if (str_contains(strtolower($item->kategori), 'yatim')) {
                $item->nominal = $request->yatim;
            }

            $item->save();
        }

        return redirect()
            ->route('spp.index')
            ->with('success','SPP berhasil diperbarui');
    }
}

    // DELETE (opsional)
    public function destroy($tahun)
{
    // Menghapus semua kategori (normal, kip, yatim) di tahun tersebut
    Spp::where('tahun', $tahun)->delete();
    
    return redirect()->route('spp.index')->with('success', "Data SPP Tahun $tahun berhasil dihapus");
}
}
