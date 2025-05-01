<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTerlapor extends Model
{
    use HasFactory;

    protected $table = 'detail_terlapor';
    protected $primaryKey = 'id_terlapor';

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}
