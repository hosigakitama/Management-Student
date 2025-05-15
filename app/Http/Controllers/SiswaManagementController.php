<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use Illuminate\Support\Facades\Storage;

class SiswaManagementController extends Controller
{
    public function index()
    {
        $siswas = siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function edit($id)
    {
        $siswa = siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = siswa::findOrFail($id);

        $siswa->nama = $request->input('nama') ?? $siswa->nama;
        $siswa->nomor_orangtua = $request->input('nomor_orangtua') ?? $siswa->nomor_orangtua;
        $siswa->alamat = $request->input('alamat') ?? $siswa->alamat;
        $siswa->kelas = $request->input('kelas') ?? $siswa->kelas;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($siswa->gambar) {
                Storage::disk('public')->delete('gambar/' . $siswa->gambar);
            }

            // Simpan gambar baru ke storage/app/public/gambar
            $gambarPath = $request->file('gambar')->store('gambar', 'public');

            // Simpan nama file ke database
            $siswa->gambar = basename($gambarPath);
        }

        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
}
