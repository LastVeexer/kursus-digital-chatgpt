<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data siswa dari database
        return Siswa::all();
    }

    /**
     * Menyimpan data siswa baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memvalidasi data yang dikirim melalui request
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:siswa',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas' => 'required|string|max:50',
        ]);

        // Membuat siswa baru berdasarkan data yang divalidasi
        return Siswa::create($request->all());
    }

    /**
     * Menampilkan data siswa berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mencari siswa berdasarkan ID
        return Siswa::find($id);
    }

    /**
     * Memperbarui data siswa yang ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Memvalidasi data yang dikirim melalui request
        $request->validate([
            'nama' => 'string|max:255',
            'email' => 'string|email|max:255|unique:siswa,email,' . $id,
            'no_telepon' => 'string|max:15',
            'alamat' => 'string',
            'tanggal_lahir' => 'date',
            'kelas' => 'string|max:50',
        ]);

        // Mencari siswa berdasarkan ID dan memperbarui data siswa tersebut
        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return $siswa;
    }

    /**
     * Menghapus data siswa dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari siswa berdasarkan ID dan menghapusnya
        return Siswa::destroy($id);
    }
}
