<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    // Method untuk mengambil semua data kursus
    public function index()
    {
        $kursus = Kursus::all();
        return response()->json($kursus);
    }

    // Method untuk mengambil data kursus berdasarkan ID
    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        return response()->json($kursus);
    }

    // Method untuk menyimpan kursus baru
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'hari' => 'required|array',
            'jam_mulai' => 'required|date_format:H:i:s',
        'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'instruktur' => 'required|string|max:255',
        ]);

        // Menghitung durasi dari jam_mulai dan jam_selesai
        $jamMulai = new \DateTime($request->jam_mulai);
        $jamSelesai = new \DateTime($request->jam_selesai);
        $durasi = $jamMulai->diff($jamSelesai)->h;

        // Menyimpan data kursus baru
        $kursus = Kursus::create([
            'nama_kursus' => $request->nama_kursus,
            'deskripsi' => $request->deskripsi,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'durasi' => $durasi,
            'instruktur' => $request->instruktur,
        ]);

        // Mengembalikan respon JSON setelah kursus berhasil ditambahkan
        return response()->json(['message' => 'Kursus berhasil ditambahkan', 'data' => $kursus], 201);
    }

    // Method untuk memperbarui data kursus berdasarkan ID
    public function update(Request $request, $id)
    {
        \Log::info('Data yang diterima:', $request->all());
    
        $this->validate($request, [
            'nama_kursus' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'hari' => 'required|array',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
            'instruktur' => 'required|string|max:255',
        ]);
    
        $kursus = Kursus::find($id);
        $kursus->update($request->all());
    
        return response()->json(['message' => 'Kursus berhasil diperbarui'], 200);
    }

    // Method untuk menghapus data kursus berdasarkan ID
    public function destroy($id)
    {
        // Mencari kursus berdasarkan ID
        $kursus = Kursus::findOrFail($id);

        // Menghapus kursus
        $kursus->delete();

        // Mengembalikan respon JSON setelah kursus berhasil dihapus
        return response()->json(['message' => 'Kursus berhasil dihapus'], 200);
    }
}
