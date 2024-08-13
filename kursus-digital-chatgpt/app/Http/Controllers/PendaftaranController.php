<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data pendaftaran dari database dengan relasi 'siswa' dan 'kursus'
        return Pendaftaran::with(['siswa', 'kursus'])->get();
    }

    /**
     * Menyimpan data pendaftaran baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memvalidasi data yang dikirim melalui request
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal_pendaftaran' => 'required|date',
            'status' => 'required|in:sedang berlangsung,selesai', // Validasi hanya mengizinkan dua status
        ]);

        // Membuat pendaftaran baru berdasarkan data yang divalidasi
        return Pendaftaran::create($request->all());
    }

    /**
     * Menampilkan data pendaftaran berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mencari pendaftaran berdasarkan ID dengan relasi 'siswa' dan 'kursus'
        return Pendaftaran::with(['siswa', 'kursus'])->findOrFail($id);
    }

    /**
     * Memperbarui data pendaftaran yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Memvalidasi data yang dikirim melalui request
        $request->validate([
            'siswa_id' => 'exists:siswa,id',
            'kursus_id' => 'exists:kursus,id',
            'tanggal_pendaftaran' => 'date',
            'status' => 'in:sedang berlangsung,selesai', // Validasi hanya mengizinkan dua status
        ]);

        // Mencari pendaftaran berdasarkan ID dan memperbarui data pendaftaran tersebut
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());

        return $pendaftaran;
    }

    /**
     * Menghapus data pendaftaran dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari pendaftaran berdasarkan ID dan menghapusnya
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return response()->json(['message' => 'Pendaftaran berhasil dihapus'], 200);
    }
}
