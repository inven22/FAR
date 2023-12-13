<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate dummy data for lapangans table
        $lapangans = [
            [
                'nama' => 'Futsal Court A',
                'deskripsi' => 'Lapangan futsal dengan rumput sintetis, ukuran standar FIFA.',
                'waktu' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Futsal Court B',
                'deskripsi' => 'Lapangan futsal indoor dengan lantai vinyl, dilengkapi dengan papan skor.',
                'waktu' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Futsal Court C',
                'deskripsi' => 'Lapangan futsal terbuka dengan lampu penerangan untuk malam hari.',
                'waktu' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lapangan futsal lainnya sesuai kebutuhan
        ];

        // Insert data into lapangans table
        DB::table('lapangans')->insert($lapangans);

    }
}

