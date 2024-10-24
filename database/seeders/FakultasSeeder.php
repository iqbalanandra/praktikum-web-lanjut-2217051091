<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $fakultas = [
            ['nama_fakultas' => 'FMIPA'],
            ['nama_fakultas' => 'FKIP'],
            ['nama_fakultas' => 'FK'],
            ['nama_fakultas' => 'FT'],
            ['nama_fakultas' => 'FEB'],
            ['nama_fakultas' => 'FP'],
        ];

        foreach ($fakultas as $data) {
            Fakultas::create($data);
        }
    }
}
