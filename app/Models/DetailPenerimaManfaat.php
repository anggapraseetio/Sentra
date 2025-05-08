<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'detail_penerima_manfaat';
    protected $primaryKey = 'id_penerima';

    protected $fillable = [
        'id_laporan',
        'id_penerima',
        'nama',
        'nik',
        'alamat',
        'umur',
        'jenis_kelamin',
        'pendidikan',
        'hubungan_dengan_terlapor',
    ];

    public function rekapan()
    {
        return $this->belongsTo(Rekapan::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke informasi anak
    public function informasi_anak()
    {
        return $this->hasOne(InformasiAnak::class, 'id_penerima', 'id_penerima');
    }
}
