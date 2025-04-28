<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Akun extends Authenticatable
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $timestamps = true;

    protected $fillable = [
        'notelp',
        'nama',
        'email',
        'jenis_kelamin',
        'alamat',
        'password',
        'role',
        'emerquest',
        'answquest',
        'otp',
        'otp_expiry',
    ];

    protected $casts = [
        'otp_expiry' => 'datetime',
    ];
}
