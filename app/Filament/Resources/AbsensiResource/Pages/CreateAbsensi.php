<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AbsensiResource;
use Filament\Notifications\NotificationException;

class CreateAbsensi extends CreateRecord
{
    protected static string $resource = AbsensiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Cek apakah karyawan sudah absen di tanggal ini
        $exists = \App\Models\Absensi::where('karyawan_id', $data['karyawan_id'])
            ->where('tanggal', $data['tanggal'])
            ->exists();

        // Jika sudah ada absensi hari ini → ini lembur
        if ($exists) {
            $data['is_overtime'] = true;
        } else {
            $data['is_overtime'] = false;
        }

        // Jika overtime tapi tidak isi alasan
        if ($data['is_overtime'] && empty($data['alasan_overtime'])) {
            throw new NotificationException('Alasan lembur wajib diisi!');
        }

        return $data;
    }
}
