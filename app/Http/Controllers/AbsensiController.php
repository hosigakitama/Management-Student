<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\absensi;
use GuzzleHttp\Client;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = absensi::with('siswa')->orderBy('tanggal', 'desc')->get();
        return view('absensi.index', compact('absensi'));
    }

    public function getAbsensi()
    {
        $absensi = absensi::with('siswa')->orderBy('tanggal', 'desc')->get();
        return response()->json($absensi);
    }

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta'); // Set timezone ke WIB (GMT+7)
        Carbon::setLocale('id'); // Gunakan bahasa Indonesia
    }

    // Menyimpan absensi masuk atau pulang
    public function absen(Request $request)
    {
        $request->validate(['uid_kartu' => 'required']);

        $siswa = siswa::where('uid_kartu', $request->uid_kartu)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Kartu tidak terdaftar'], 404);
        }

        $tanggal = Carbon::today()->toDateString();
        $jam_sekarang = Carbon::now()->format('H:i:s');
        $absensi = absensi::where('siswa_id', $siswa->id)->where('tanggal', $tanggal)->first();

        $batas_masuk = "07:30:00";
        $batas_pulang = "16:00:00";
        $nomor_orangtua = $siswa->nomor_orangtua; // Ambil nomor orang tua dari database

        if (!$absensi) {
            // Absensi masuk
            $status = (strtotime($jam_sekarang) > strtotime($batas_masuk)) ? 'Terlambat' : 'Hadir';

            absensi::create([
                'siswa_id' => $siswa->id,
                'tanggal' => $tanggal,
                'jam_masuk' => $jam_sekarang,
                'status' => $status
            ]);

            $this->kirimPesan($nomor_orangtua, "Anak Anda, {$siswa->nama}, telah absen masuk ($status) pada $jam_sekarang WIB.");

            return response()->json(['message' => "Absensi masuk berhasil ($status) pada $jam_sekarang WIB"], 200);
        } elseif (!$absensi->jam_pulang) {
            // Cek apakah sudah melewati jam pulang
            if (strtotime($jam_sekarang) < strtotime($batas_pulang)) {
                return response()->json(['message' => 'Maaf, ini belum jam pulang. Pulang hanya bisa setelah 16:00 WIB.'], 400);
            }

            // Absensi pulang
            $absensi->update(['jam_pulang' => $jam_sekarang]);

            $this->kirimPesan($nomor_orangtua, "Anak Anda, {$siswa->nama}, telah absen pulang pada $jam_sekarang WIB.");

            return response()->json(['message' => "Absensi pulang berhasil pada $jam_sekarang WIB"], 200);
        } else {
            return response()->json(['message' => 'Absensi sudah lengkap hari ini'], 400);
        }
    }

    private function kirimPesan($nomor, $pesan)
    {
        if (!$nomor) return;

        $token = "BAEQa39z8Fn8GJxw2Q74";
        $client = new Client();

        try {
            $client->post('https://api.fonnte.com/send', [
                'headers' => [
                    'Authorization' => $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'target' => $nomor,
                    'message' => $pesan,
                    'delay' => 2,
                    'schedule' => 0,
                ],
            ]);
        } catch (\Exception $e) {
        }
    }

    // Mendapatkan riwayat absensi semua siswa
    public function getAllAbsensi()
    {
        $absensi = absensi::with('siswa')->get();
        return response()->json($absensi);
    }

    // Mendapatkan riwayat absensi siswa berdasarkan UID
    public function getAbsensiByUID($uid_kartu)
    {
        $siswa = siswa::where('uid_kartu', $uid_kartu)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $absensi = absensi::where('siswa_id', $siswa->id)->get();
        return response()->json($absensi);
    }
}
