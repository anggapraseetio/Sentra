<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';

    protected $primaryKey = 'id_notif';
    public $timestamps = false;

    protected $fillable = [
        'id_akun',
        'judul',
        'pesan',
        'tipe',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'id_akun');
    }
}
