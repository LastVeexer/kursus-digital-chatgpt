<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel yang terkait dengan model ini
    protected $table = 'pendaftaran';

    // Mendefinisikan kolom yang dapat diisi secara massal
    protected $fillable = ['siswa_id', 'kursus_id', 'tanggal_pendaftaran', 'status'];

    // Definisi status pendaftaran yang valid
    const STATUS_SEDANG_BERLANGSUNG = 'sedang berlangsung';
    const STATUS_SELESAI = 'selesai';

    // Validasi status agar hanya menerima dua opsi yang diizinkan
    public function setStatusAttribute($value)
    {
        if (!in_array($value, [self::STATUS_SEDANG_BERLANGSUNG, self::STATUS_SELESAI])) {
            throw new \InvalidArgumentException("Status yang dipilih tidak valid.");
        }

        $this->attributes['status'] = $value;
    }

    // Mendefinisikan relasi many-to-one dengan model 'Siswa'
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Mendefinisikan relasi many-to-one dengan model 'Kursus'
    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
