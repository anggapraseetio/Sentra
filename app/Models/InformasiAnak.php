<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAnak extends Model
{
    use HasFactory;

    protected $table = 'informasi_anak';
    protected $primaryKey = 'id_anak';
    protected $fillable = [
        'id_penerima',
        'nama',
        'umur',
        'jenis_kelamin',
        'pendidikan',
    ];

    public function penerima_manfaat()
    {
        return $this->belongsTo(DetailPenerimaManfaat::class, 'id_penerima', 'id_penerima');
    }
}
