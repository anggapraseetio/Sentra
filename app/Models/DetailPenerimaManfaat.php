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
    
    // Di dalam model DetailPenerimaManfaat
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if ($model->tanggal_lahir) {
                // Menghitung umur otomatis saat membuat record baru
                $model->umur = Carbon::parse($model->tanggal_lahir)->age;
            }
        });
        
        static::updating(function ($model) {
            if ($model->tanggal_lahir) {
                // Menghitung ulang umur saat data tanggal lahir diperbarui
                $model->umur = Carbon::parse($model->tanggal_lahir)->age;
            }
        });
    }
    protected $fillable = [
        'id_laporan',
        'id_penerima',
        'nama',
        'nik',
        'alamat',
        'umur',
        'jenis_kelamin',
        'pendidikan',
        'hubungan_dengan_terlapor',
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
}
