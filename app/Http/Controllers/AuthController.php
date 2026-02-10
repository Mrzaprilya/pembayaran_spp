<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
{
    $request->validate([
        'login'    => 'required',
        'password' => 'required',
        'role'     => 'required',
    ]);

    /*
    |--------------------------------------------------------------------------
    | LOGIN SISWA
    |--------------------------------------------------------------------------
    */
    if ($request->role === 'siswa') {

        $siswa = Siswa::where('nama', $request->login)->first();

        if (!$siswa) {
            return back()
                ->withErrors(['login' => 'Nama siswa tidak ditemukan'])
                ->withInput();
        }

        if ($request->password !== $siswa->nisn) {
            return back()
                ->withErrors(['password' => 'NISN salah'])
                ->withInput();
        }

        session([
            'login'    => true,
            'siswa_id' => $siswa->id,
            'nama'     => $siswa->nama,
            'level'    => 'siswa',
        ]);

        return redirect('/siswa');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN PETUGAS / ADMIN
    |--------------------------------------------------------------------------
    */
    $petugas = Petugas::where('username', $request->login)->first();

    if (!$petugas) {
        return back()
            ->withErrors(['login' => 'Username tidak ditemukan'])
            ->withInput();
    }

    if (!Hash::check($request->password, $petugas->password)) {
        return back()
            ->withErrors(['password' => 'Password salah'])
            ->withInput();
    }

    session([
        'login'      => true,
        'petugas_id' => $petugas->id,
        'nama'       => $petugas->nama,
        'level'      => $petugas->level,
    ]);

    return $petugas->level === 'admin'
        ? redirect('/admin')
        : redirect('/petugas');
}

    
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
