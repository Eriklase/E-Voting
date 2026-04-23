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
        for ($i = 1; $i <= 10; $i++) {

            $user = User::updateOrCreate(
                ['email' => "mahasiswa{$i}@gmail.com"],
                [
                    'name' => "Mahasiswa $i",
                    'password' => Hash::make('123456'),
                    'role' => 'mahasiswa',
                ]
            );

            Mahasiswa::updateOrCreate(
                ['nim' => '201111' . str_pad($i, 3, '0', STR_PAD_LEFT)],
                [
                    'nama' => "Mahasiswa $i",
                    'jurusan' => ['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika'][array_rand([0,1,2])],
                    'angkatan' => ['2020', '2021', '2022', '2023'][array_rand([0,1,2,3])],
                    'user_id' => $user->id,
                ]
            );
        }
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