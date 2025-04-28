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
            'password' => Hash::make('admin123'), // password terenkripsi
            'role' => 'admin',
            'emerquest' => null,
            'answquest' => null,
            'otp' => null,
            'otp_expiry' => null,
        ]);
    }
}
