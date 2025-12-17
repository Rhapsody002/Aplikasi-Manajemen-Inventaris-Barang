<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lokasi' => 'RAK A1',
                'keterangan'  => 'Rak A lantai 1'
            ],
            [
                'nama_lokasi' => 'RAK A2',
                'keterangan'  => 'Rak A lantai 2'
            ],
            [
                'nama_lokasi' => 'RAK B1',
                'keterangan'  => 'Rak B lantai 1'
            ],
        ];

        foreach ($data as $lokasi) {
            Lokasi::create($lokasi);
        }
    }
}

