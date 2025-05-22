<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class DetailPenerimaManfaat extends Model
{
    use HasFactory;

    protected $table = 'detail_penerima_manfaat';
    protected $primaryKey = 'id_penerima';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'id_penerima',
        'nama',
        'nik',
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
    ];

    public function rekapan()
    {
        return $this->belongsTo(Rekapan::class, 'id_laporan', 'id_laporan');
    }

    // Relasi ke informasi anak
    public function informasi_anak()
    {
        return $this->hasMany(InformasiAnak::class, 'id_penerima', 'id_penerima');
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
        $this->attributes['notelp'] = Crypt::encryptString($value);
    }
}
