<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            "Sparepart",
            "Solar",
            "Keperluan lapangan",
        ];

        foreach ($kategori as $kategori) {
            DB::table('kategori')->insert([
                'nama_kategori' => $kategori,
          ]);

        }
    }
}
