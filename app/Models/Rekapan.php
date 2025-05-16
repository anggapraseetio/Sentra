<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekapan extends Model
{
    protected $table = 'rekapan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = true;
    protected $fillable = [
        'id_laporan',
        'nama',
        'nik',
        'created_at',
        'kategori',
        'status'
    ];

    // Relasi ke detail_pelapor
    public function detail_pelapor()
    {
        return $this->hasOne(DetailPelapor::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke detail_penerima_manfaat
    public function detail_penerima_manfaat()
    {
        return $this->hasOne(DetailPenerimaManfaat::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke detail_terlapor
    public function detail_terlapor()
    {
        return $this->hasOne(DetailTerlapor::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke detail_kasus
    public function detail_kasus()
    {
        return $this->hasOne(DetailKasus::class, 'id_laporan', 'id_laporan');
    }
}
