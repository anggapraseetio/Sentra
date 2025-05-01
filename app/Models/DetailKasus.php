<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKasus extends Model
{
    use HasFactory;

    protected $table = 'detail_kasus';
    protected $primaryKey = 'id_kasus';

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}