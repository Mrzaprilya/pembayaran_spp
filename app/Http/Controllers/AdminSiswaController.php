<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::with(['kelas', 'spp'])->get();
        return view('admin.siswa.index', compact('data'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $spp   = Spp::all();

        return view('admin.siswa.create', compact('kelas', 'spp'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nisn' => 'required|unique:siswa,nisn',
        'nis' => 'required|unique:siswa,nis',
        'nama' => 'required',
        'kelas_id' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required',
        'spp_id' => 'required',
    ]);

    // Simpan data siswa langsung tanpa buat akun User
    Siswa::create([
        'nisn' => $request->nisn,
        'nis' => $request->nis,
        'nama' => $request->nama,
        'kelas_id' => $request->kelas_id,
        'alamat' => $request->alamat,
        'no_telp' => $request->no_telp,
        'spp_id' => $request->spp_id,
    ]);

    return redirect('/admin/siswa')->with('success', 'Data siswa berhasil ditambahkan!');
}

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $spp   = Spp::all();

        return view('admin.siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|unique:siswa,nisn,' . $siswa->id,
            'nis' => 'required|unique:siswa,nis,' . $siswa->id,
            'nama' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'spp_id' => 'required',
        ]);

        $siswa->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'spp_id' => $request->spp_id,
        ]);

        // Update nama user juga biar sinkron
        if ($siswa->user_id) {
            $user = User::find($siswa->user_id);
            if ($user) {
                $user->update([
                    'name' => $request->nama
                ]);
            }
        }

        return redirect('/admin/siswa')->with('success', 'Data siswa berhasil diupdate!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // hapus user login siswa juga biar bersih
        if ($siswa->user_id) {
            User::where('id', $siswa->user_id)->delete();
        }

        $siswa->delete();

        return redirect('/admin/siswa')->with('success', 'Data siswa berhasil dihapus!');
    }
    
}
