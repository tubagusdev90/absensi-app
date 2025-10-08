<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id', 'tanggal', 'waktu_masuk', 'waktu_pulang',
        'is_overtime', 'alasan_overtime', 'foto_masuk', 'foto_pulang'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    protected static function booted()
    {
        static::creating(function ($absen) {
            // Jika sudah absen hari ini → ubah jadi overtime
            $exists = Absensi::where('karyawan_id', $absen->karyawan_id)
                ->where('tanggal', $absen->tanggal)
                ->exists();

            $absen->is_overtime = $exists;

            if ($absen->is_overtime && empty($absen->alasan_overtime)) {
                throw new \Exception("Alasan lembur wajib diisi!");
            }
        });
    }
}
