<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'detail_penerima_manfaat';
    protected $primaryKey = 'id_penerima';

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke informasi anak
    public function informasi_anak()
    {
        return $this->hasOne(InformasiAnak::class, 'id_penerima', 'id_penerima');
    }
}
