<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang terkait dengan model ini
    protected $table = 'siswa';

    // Mendefinisikan kolom yang dapat diisi secara massal
    protected $fillable = ['nama', 'email', 'no_telepon', 'alamat', 'tanggal_lahir', 'kelas'];

    // Mendefinisikan relasi one-to-many dengan model 'Pendaftaran'
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
