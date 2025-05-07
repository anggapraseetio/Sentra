<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPelapor extends Model
{
    use HasFactory;

    protected $table = 'detail_pelapor';
    protected $primaryKey = 'id_pelapor';
    public $timestamps = false;


    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'hubungan_dengan_korban',
        'no_telp',
        'id_laporan',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}
