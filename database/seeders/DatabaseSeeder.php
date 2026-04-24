<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kandidat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Sistem',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        // Create a sample mahasiswa user for login (credentials below)
        // Email: mahasiswa1@example.com
        // Password: password
        $mahasiswaUser = User::updateOrCreate(
            ['email' => 'mahasiswa1@example.com'],
            [
                'name' => 'Mahasiswa 1',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
            ]
        );

        Mahasiswa::updateOrCreate(
            ['nim' => '201111001'],
            [
                'nama' => 'Mahasiswa 1',
                'jurusan' => 'Teknik Informatika',
                'angkatan' => '2023',
                'user_id' => $mahasiswaUser->id,
            ]
        );
        // NOTE: Auto-creation of 10 sample mahasiswa users has been removed.
        // If you need to reseed sample users, re-enable or create a dedicated seeder.
        $kandidats = [
            [
                'nama_kandidat' => 'Ahmad Rivaldi',
                'visi' => 'Membangun Senat Fakultas yang progresif dan responsif terhadap kebutuhan mahasiswa',
                'misi' => 'Meningkatkan komunikasi antar mahasiswa dan pemberdayaan organisasi mahasiswa',
            ],
            [
                'nama_kandidat' => 'Siti Nurhaliza',
                'visi' => 'Menciptakan ekosistem akademik yang inklusif',
                'misi' => 'Memperkuat kolaborasi antar program studi',
            ],
            [
                'nama_kandidat' => 'Bambang Sutrisno',
                'visi' => 'Mewujudkan Senat Fakultas yang kuat dan berintegritas',
                'misi' => 'Meningkatkan kesejahteraan mahasiswa',
            ],
        ];

        foreach ($kandidats as $kandidat) {
            Kandidat::updateOrCreate(
                ['nama_kandidat' => $kandidat['nama_kandidat']],
                $kandidat
            );
        }
    }
}