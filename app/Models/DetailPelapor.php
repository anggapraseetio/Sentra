<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
    // NIK
    public function getNikAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value; // fallback kalau nilainya belum terenkripsi
        }
    }

    public function setNikAttribute($value)
    {
        $this->attributes['nik'] = Crypt::encryptString($value);
    }

    // No Telepon
    public function getNoTelpAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function setNoTelpAttribute($value)
    {
        $this->attributes['no_telp'] = Crypt::encryptString($value);
    }
}
