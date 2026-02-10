<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPetugasController extends Controller
{
    public function index()
    {
        $data = Petugas::all();
        return view('admin.petugas.index', compact('data'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:6',
            'level' => 'required|in:admin,petugas',
        ]);

        Petugas::create([
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Cegah edit admin utama (ID = 1)
        if ($id == 1) {
            return redirect()->route('petugas.index')
                ->with('error', 'Admin utama tidak dapat diedit');
        }
        
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
{
    // Cegah update admin utama (ID = 1)
    if ($id == 1) {
        return redirect()->route('petugas.index')
            ->with('error', 'Admin utama tidak dapat diedit');
    }
    
    $petugas = Petugas::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'username' => 'required|unique:petugas,username,' . $petugas->id,
        'level' => 'required|in:admin,petugas', // validasi level
        'password' => 'nullable|min:6', // password opsional
    ]);

    $petugas->nama = $request->nama;
    $petugas->username = $request->username;
    $petugas->level = $request->level; // update level

    // update password hanya jika diisi
    if ($request->password) {
        $petugas->password = Hash::make($request->password);
    }

    $petugas->save();

    return redirect()->route('petugas.index')
        ->with('success', 'Petugas berhasil diperbarui');
}

    public function destroy($id)
    {
        // Cegah hapus admin utama (ID = 1)
        if ($id == 1) {
            return back()->with('error', 'Admin utama tidak dapat dihapus');
        }
        
        Petugas::findOrFail($id)->delete();
        return back()->with('success', 'Petugas berhasil dihapus');
    }
}
