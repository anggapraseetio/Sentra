<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAnak extends Model
{
    use HasFactory;

    protected $table = 'informasi_anak';
    protected $primaryKey = 'id_anak';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'pendidikan',
        'agama',
        'status',
        'id_penerima', // jika relasi laporan diperlukan
    ];

    public function penerima_manfaat()
    {
        return $this->belongsTo(DetailPenerimaManfaat::class, 'id_penerima', 'id_penerima');
    }
}