<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserMobile extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'akun'; // Nama tabel sesuai dengan database kamu
    protected $primaryKey = 'id_akun'; // Primary key yang digunakan

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
        'fcm_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expiry' => 'datetime',
    ];
}
