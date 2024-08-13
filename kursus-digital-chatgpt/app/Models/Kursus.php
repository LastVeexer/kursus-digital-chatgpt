<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang terkait dengan model ini
    protected $table = 'kursus';

    // Mendefinisikan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_kursus',
        'deskripsi',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'durasi',
        'instruktur'
    ];

    // Menambahkan casts untuk hari agar di-handle sebagai array
    protected $casts = [
        'hari' => 'array',
        'jam_mulai' => 'string',
        'jam_selesai' => 'string',
    ];

    // Mendefinisikan relasi one-to-many dengan model 'Pendaftaran'
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
