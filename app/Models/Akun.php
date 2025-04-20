<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $timestamps = true;

    protected $fillable = [
        'notelp',
        'nama',
        'email',
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
