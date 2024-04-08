<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengguna = [
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt(12345678),
            'level' => 'admin'
        ];

        Pengguna::create($pengguna);
    }
}
