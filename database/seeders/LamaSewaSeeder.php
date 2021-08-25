<?php

namespace Database\Seeders;

use App\Models\MasterLamaSewa;
use Illuminate\Database\Seeder;

class LamaSewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bulans = [
          '1 bulan',
          '2 bulan',
          '3 bulan',
          '4 bulan',
          '5 bulan',
          '6 bulan',
          '7 bulan',
          '8 bulan',
          '9 bulan',
          '10 bulan',
          '11 bulan',
          '12 bulan',
        ];

        foreach($bulans as $key => $item) {
            MasterLamaSewa::firstOrCreate([
               'bulan' => $item
            ]);
        }
    }
}
