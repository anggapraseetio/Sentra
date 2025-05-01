<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiAnak extends Model
{
    use HasFactory;

    protected $table = 'informasi_anak';
    protected $primaryKey = 'id_anak';

    public function penerima_manfaat()
    {
        return $this->belongsTo(DetailPenerimaManfaat::class, 'id_penerima', 'id_penerima');
    }
}
