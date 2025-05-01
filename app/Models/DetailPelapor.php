<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPelapor extends Model
{
    use HasFactory;

    protected $table = 'detail_pelapor';
    protected $primaryKey = 'id_pelapor';

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}
