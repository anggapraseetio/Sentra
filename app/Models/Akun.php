<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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

    public function setPasswordAttribute($value)
    {
        // Hanya hash kalau password-nya memang belum di-hash
        if (Hash::needsRehash($value)) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }

    public function getNotelpAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return $value;
        }
    }

    public function setNotelpAttribute($value)
    {
        $this->attributes['notelp'] = Crypt::encryptString($value);
    }
}
