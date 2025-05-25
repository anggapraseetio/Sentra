<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        Akun::create([
            'notelp' => '087860616270',
            'nama' => 'Admin',
            'email' => 'sentraapplication@gmail.com',
            'jenis_kelamin' => null,
            'alamat' => null,
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
            'emerquest' => null,
            'answquest' => null,
            'otp' => null,
            'otp_expiry' => null,
        ]);
        Akun::create([
            'notelp' => '081234554321',
            'nama' => 'Admin Konsultasi',
            'email' => null,
            'jenis_kelamin' => null,
            'alamat' => null,
            'password' => Hash::make('adminkonsul123'), 
            'role' => 'admin',
            'emerquest' => null,
            'answquest' => null,
            'otp' => null,
            'otp_expiry' => null,
        ]);
        Akun::create([
            'notelp' => '087860616277',
            'nama' => 'Guest',
            'email' => null,
            'jenis_kelamin' => null,
            'alamat' => null,
            'password' => Hash::make('guest321'), 
            'role' => 'guest',
            'emerquest' => null,
            'answquest' => null,
            'otp' => null,
            'otp_expiry' => null,
        ]);
    }
}
