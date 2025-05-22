<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTerlapor extends Model
{
    use HasFactory;

    protected $table = 'detail_terlapor';
    protected $primaryKey = 'id_terlapor';
    public $timestamps = false;


    protected $fillable = [
        'nik',
        'nama',
        'umur',
        'alamat',
        'jenis_kelamin',
        'hubungan_dengan_korban',
        'informasi_tambahan',
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
}
