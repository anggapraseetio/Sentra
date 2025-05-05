<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'detail_penerima_manfaat';
    protected $primaryKey = 'id_penerima';
    public $timestamps = false;


    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'pekerjaan',
        'agama',
        'alamat',
        'pendidikan',
        'hubungan_dengan_terlapor',
        'notelp',
        'informasi_tambahan',
        'id_laporan', // jika relasi laporan diperlukan
    ];

    // Relasi ke informasi anak
    public function informasi_anak()
    {
        return $this->hasMany(InformasiAnak::class, 'id_penerima');
        
    }
    protected static function booted()
    {
        static::deleting(function ($penerima) {
            $penerima->informasi_anak()->delete();
        });
    }    
    
}
