<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    // Menyimpan data kartu RFID yang baru dipindai
    public function registerRFID(Request $request)
    {
        $request->validate([
            'uid_kartu' => 'required|unique:siswas,uid_kartu',
        ]);

        // Menyimpan data siswa baru berdasarkan UID
        $siswa = siswa::create([
            'uid_kartu' => $request->uid_kartu,
        ]);

        return response()->json(['message' => 'Kartu berhasil terdaftar', 'siswa' => $siswa], 201);
    }

    // Mengupdate data siswa setelah RFID terdaftar
    public function updateSiswa(Request $request, $id)
    {
        $siswa = siswa::findOrFail($id);

        // Validasi untuk data siswa yang bisa diupdate
        $request->validate([
            'nama' => 'nullable|string',
            'gambar' => 'nullable|string',
            'nomor_orangtua' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kelas' => 'nullable|string',
        ]);

        // Update hanya field yang ada di request
        $siswa->update($request->only(['nama', 'gambar', 'nomor_orangtua', 'alamat', 'kelas']));

        return response()->json(['message' => 'Data siswa berhasil diperbarui', 'siswa' => $siswa], 200);
    }

    // Mendapatkan daftar semua siswa
    public function getAllSiswa()
    {
        $siswa = siswa::all();

        if ($siswa->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data siswa'], 404);
        }

        return response()->json($siswa);
    }

    // Mendapatkan detail siswa berdasarkan UID kartu
    public function getSiswaByUID($uid_kartu)
    {
        $siswa = siswa::where('uid_kartu', $uid_kartu)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        return response()->json(['siswa' => $siswa]);
    }
}
