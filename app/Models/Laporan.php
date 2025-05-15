<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = true;

    
    public function detail_pelapor()
    {
        return $this->hasOne(DetailPelapor::class, 'id_laporan', 'id_laporan');
    }

    
    public function detail_penerima_manfaat()
    {
        return $this->hasOne(DetailPenerimaManfaat::class, 'id_laporan', 'id_laporan');
    }

    
    public function detail_terlapor()
    {
        return $this->hasOne(DetailTerlapor::class, 'id_laporan', 'id_laporan');
    }

    
    public function detail_kasus()
    {
        return $this->hasOne(DetailKasus::class, 'id_laporan', 'id_laporan');
    }

    // public function informasi_anak()
    // {
    //     return $this->hasOne(InformasiAnak::class, 'id_penerima');
    // }

}


