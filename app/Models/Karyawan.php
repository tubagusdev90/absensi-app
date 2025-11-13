<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Karyawan extends Model
{
    use HasFactory;

    // protected $table = 'karyawans';

    protected $fillable = [
        'nama_karyawan',
        'email',
        'team_id',
        'position_id',
    ];

    /**
     * Karyawan milik satu Team.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Akses cepat ke Departemen melalui Team (bukan relasi Eloquent murni).
     * Untuk dipakai di kode biasa (bukan untuk eager load/Filament column chaining).
     */
    public function getDepartemenAttribute()
    {
        return $this->team?->departemen;
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function position()
    {
        return $this->belongsTo(\App\Models\Position::class, 'position_id');
    }

}
